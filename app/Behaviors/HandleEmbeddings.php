<?php

namespace App\Behaviors;

use App\Models\Collections\Artwork;
use App\Services\AIPrompts;
use Illuminate\Support\Facades\Http;
use App\Models\Web\Vectors\TextEmbedding;
use App\Models\Web\Vectors\ImageEmbedding;
use Pgvector\Laravel\Vector;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\OutputInterface;

trait HandleEmbeddings
{
    public function generateAndSaveArtworkEmbeddngs(Artwork $artwork): void
    {
        try {
            $this->info(
                "\nProcessing artwork: {$artwork->title} (ID: {$artwork->id})",
                OutputInterface::VERBOSITY_VERBOSE
            );

            $imageUrl = $this->buildImageUrl($artwork);
            $this->info("Image URL: {$imageUrl}", OutputInterface::VERBOSITY_VERBOSE);

            $analysisResults = $this->analyzeArtworkImage($artwork, $imageUrl);
            $this->processEmbeddings($artwork, $imageUrl, $analysisResults);
        } catch (\Exception $e) {
            \Log::error('Error processing artwork:', [
                'artwork_id' => $artwork->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $this->error(
                "\nFailed processing artwork ID {$artwork->id}: {$e->getMessage()}"
            );
        }
    }

    public function generateAndSaveWebEmbeddngs($item): void
    {
        try {
            $this->info(
                "\nProcessing web content: {$item->title} (ID: {$item->id})",
                OutputInterface::VERBOSITY_VERBOSE
            );

            // Get and save text embeddings
            $this->info("\nGetting text embeddings...", OutputInterface::VERBOSITY_VERBOSE);
            $textEmbeddingArray = app('Embeddings')->getEmbeddings($item->copy);

            $this->saveTextEmbeddings($item, $textEmbeddingArray);
            $this->info("Saved text embeddings", OutputInterface::VERBOSITY_VERBOSE);
        } catch (\Exception $e) {
            \Log::error('Error processing artwork:', [
                'artwork_id' => $item->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $this->error(
                "\nFailed processing artwork ID {$item->id}: {$e->getMessage()}"
            );
        }
    }

    public function saveEmbeddings(
        string $modelName,
        int $modelId,
        array $embedding,
        string $type,
        ?array $additionalData = null
    ): array {
        // Create vector from array
        $vector = new Vector($embedding);

        $embeddingModel = $type === 'text' ? TextEmbedding::class : ImageEmbedding::class;
        $version = config('azure.' . ($type === 'text' ? 'embedding' : 'image_embedding') . '.version');

        $result = $embeddingModel::updateOrCreate(
            [
                    'model_name' => $modelName,
                    'model_id' => $modelId,
                ],
            [
                    'version' => $version,
                    'data' => $additionalData,
                    'embedding' => $vector,
                ]
        );

        return [
            'success' => true,
            'message' => 'Embedding saved successfully',
            'embedding_id' => $result->id
        ];
    }

    public function saveArtworkDescription(
        int $artworkId,
        array $description,
        array $generationData
    ): array {
        $modelName = 'artworks';
        $version = config('azure.image_analysis.version');

        // Save image analysis data
        $newData = [
            'generation_data' => $generationData,
            'description' => $description,
            'description_generated_at' => now()->toDateTimeString(),
        ];

        $imageEmbedding = ImageEmbedding::updateOrCreate(
            [
                    'model_name' => $modelName,
                    'model_id' => $artworkId,
                ],
            [
                    'version' => $version,
                    'data' => $newData,
                ]
        );

        // Generate and save text embeddings from description
        $descriptionText = $this->formatDescriptionText($description);
        $textEmbeddingsSaved = false;

        if ($descriptionText) {
            $textEmbedding = app('Embeddings')->getEmbeddings($descriptionText);
            if ($textEmbedding) {
                $this->saveEmbeddings(
                    modelName: $modelName,
                    modelId: $artworkId,
                    embedding: $textEmbedding,
                    type: 'text',
                    additionalData: [
                        'description_source' => 'image_analysis',
                        'description' => $descriptionText,
                        'generated_at' => now()->toDateTimeString()
                    ]
                );
                $textEmbeddingsSaved = true;
            }
        }

        return [
            'success' => true,
            'message' => 'Artwork description saved successfully',
            'embedding_id' => $imageEmbedding->id,
            'text_embedding_saved' => $textEmbeddingsSaved
        ];
    }

    public function getImageDescription(string $imageUrl): array
    {
        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => config('azure.image_analysis.key')
        ])->post(config('azure.image_analysis.endpoint'), [
            'url' => $imageUrl
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return [
                'caption' => $data['captionResult']['text'] ?? null,
                'denseCaption' => $data['denseCaptionsResult']['values'] ?? null,
                'tags' => $data['tagsResult']['values'] ?? null,
                'objects' => $data['objectsResult']['values'] ?? null,
                'peopleLocation' => $data['peopleResult']['values'] ?? null,
            ];
        }

        throw new Exception('Failed to get image description: ' . app('Embeddings')->getResponseError($response->json()));
    }
    /**
     * Rate-limit requests across parallel processes using a shared temp file.
     * Returns after the required delay has elapsed.
     */
    private static function rateLimitWait(float $delaySeconds): void
    {
        $lockFile = sys_get_temp_dir() . '/alt-text-rate-limiter.lock';
        $fp = fopen($lockFile, 'c+');
        if (!$fp) {
            usleep((int)($delaySeconds * 1_000_000));
            return;
        }

        flock($fp, LOCK_EX);
        $lastTime = (float)(fgets($fp) ?: 0);
        $now = microtime(true);
        $wait = $delaySeconds - ($now - $lastTime);

        if ($wait > 0) {
            flock($fp, LOCK_UN);
            fclose($fp);
            usleep((int)($wait * 1_000_000));
            // Re-acquire to update timestamp
            $fp = fopen($lockFile, 'c+');
            flock($fp, LOCK_EX);
        }

        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, (string)microtime(true));
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    public function getLLMImageDescription(string $imageUrl, string $promptType = 'standard'): array
    {
        $promptText = AIPrompts::getAltTextPrompt($promptType);

        $maxRetries = 5;
        $baseDelay = 2; // seconds

        for ($attempt = 0; $attempt <= $maxRetries; $attempt++) {
            // Honor global rate limit if set
            $rpm = (int)config('azure.chat.rate_limit_rpm', 0);
            if ($rpm > 0) {
                self::rateLimitWait(60.0 / $rpm);
            }

            $response = Http::withHeaders([
                'api-key' => config('azure.chat.key'),
                'Content-Type' => 'application/json'
            ])->post(config('azure.chat.endpoint') . '/openai/deployments/' . config('azure.chat.model') . '/chat/completions?api-version=' . config('azure.chat.version'), [
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an expert at analyzing images for accessibility.'
                    ],
                    [
                        'role' => 'user',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => $promptText
                            ],
                            [
                                'type' => 'image_url',
                                'image_url' => [
                                    'url' => $imageUrl
                                ]
                            ]
                        ]
                    ]
                ],
                'max_completion_tokens' => 2000,
                'temperature' => 1
            ]);

            // Unsupported format — permanent failure, don't retry
            if ($response->status() === 400 && str_contains($response->body(), 'unsupported image')) {
                $msg = $response->json()['error']['message'] ?? 'unsupported image format';
                throw new Exception('Failed to get image description: ' . $msg);
            }

            // Rate-limited: back off and retry
            if ($response->status() === 429) {
                $retryAfter = (int)($response->header('Retry-After') ?? 0);
                $delay = $retryAfter > 0 ? $retryAfter : $baseDelay * pow(2, $attempt);
                $delay = min($delay, 120); // cap at 2 min

                if ($attempt < $maxRetries) {
                    if (isset($this->output) && method_exists($this, 'warn')) {
                        $this->warn("  ⚠️ Rate limited (429). Retry {$attempt}/{$maxRetries} after {$delay}s…", OutputInterface::VERBOSITY_VERBOSE);
                    }
                    sleep((int)$delay);
                    continue;
                }
            }

            if ($response->successful()) {
                $data = $response->json();
                $messageContent = $data['choices'][0]['message']['content'] ?? null;

                if (!$messageContent) {
                    throw new Exception('No content in response');
                }

                return [
                    'caption' => $messageContent,
                ];
            }

            // Server error: retry
            if ($response->serverError() && $attempt < $maxRetries) {
                sleep($baseDelay * pow(2, $attempt));
                continue;
            }

            $errorMessage = 'Failed to get image description';

            if ($response->json() && isset($response->json()['error'])) {
                $error = $response->json()['error'];
                $errorMessage .= ': ' . ($error['message'] ?? json_encode($error));
            } else {
                $errorMessage .= ': ' . $response->body();
            }

            if ($attempt < $maxRetries) {
                sleep($baseDelay);
                continue;
            }

            throw new Exception($errorMessage);
        }

        throw new Exception('Failed to get image description after ' . $maxRetries . ' retries');
    }

    protected function formatDescriptionText(array $description): string
    {
        $text = '';

        if (!empty($description['caption'])) {
            $text .= $description['caption'] . ' ';
        }

        if (!empty($description['denseCaption'])) {
            foreach ($description['denseCaption'] as $caption) {
                if (!empty($caption['text']) && ($caption['confidence'] ?? 0) > self::CONFIDENCE_THRESHOLD_CAPTION) {
                    $text .= $caption['text'] . ' ';
                }
            }
        }

        if (!empty($description['tags'])) {
            foreach ($description['tags'] as $tag) {
                if (!empty($tag['name']) && ($tag['confidence'] ?? 0) > self::CONFIDENCE_THRESHOLD_TAG) {
                    $text .= $tag['name'] . ' ';
                }
            }
        }

        return trim($text);
    }

    public function buildImageUrl(Artwork $artwork): string
    {
        if (empty($artwork->getImageAttribute()?->netx_uuid)) {
            throw new Exception("No image ID found for artwork {$artwork->id}");
        }

        return sprintf(
            config('aic.config_documentation.iiif_url') . '/%s/full/full/0/default.jpg',
            $artwork->getImageAttribute()->netx_uuid
        );
    }

    public function analyzeArtworkImage(Artwork $artwork, string $imageUrl): array
    {
        $this->info("\nPerforming image analysis...", OutputInterface::VERBOSITY_VERBOSE);

        // Get image description
        $generatedDescription = $this->getImageDescription($imageUrl);
        $this->info("Generated base description", OutputInterface::VERBOSITY_VERBOSE);

        // Get AIC description if available
        $aicDescription = $artwork->description;

        // Summarize descriptions
        $summarizedDescription = app('Descriptions')->summarizeImageDescription(
            $aicDescription,
            $generatedDescription
        );
        $this->info("Generated summarized description", OutputInterface::VERBOSITY_VERBOSE);

        return [
            'generated' => $generatedDescription,
            'original' => $aicDescription,
            'summarized' => $summarizedDescription,
        ];
    }

    public function processEmbeddings(
        Artwork $artwork,
        string $imageUrl,
        array $analysisResults
    ): void {
        $this->info("\nProcessing embeddings...", OutputInterface::VERBOSITY_VERBOSE);

        // Get and save image embeddings
        $imageEmbeddingArray = app('Embeddings')->getImageEmbeddings($imageUrl);

        $this->info(
            "Image embedding response type: " . gettype($imageEmbeddingArray),
            OutputInterface::VERBOSITY_VERBOSE
        );

        if (is_array($imageEmbeddingArray)) {
            $this->info(
                "Image embedding array count: " . count($imageEmbeddingArray),
                OutputInterface::VERBOSITY_VERBOSE
            );
        }

        try {
            $this->saveImageEmbeddings($artwork, $imageEmbeddingArray, $imageUrl, $analysisResults);
            $this->info("Saved image embeddings", OutputInterface::VERBOSITY_VERBOSE);
        } catch (\Exception $e) {
            throw new Exception("Failed to save image embeddings: " . $e->getMessage());
        }

        // Get and save text embeddings
        $this->info("\nGetting text embeddings...", OutputInterface::VERBOSITY_VERBOSE);
        $textEmbeddingArray = app('Embeddings')->getEmbeddings($analysisResults['summarized']);

        try {
            $this->saveTextEmbeddings($artwork, $textEmbeddingArray, $imageUrl, $analysisResults);
            $this->info("Saved text embeddings", OutputInterface::VERBOSITY_VERBOSE);
        } catch (\Exception $e) {
            throw new Exception("Failed to save text embeddings: " . $e->getMessage());
        }
    }

    protected function saveImageEmbeddings(
        Artwork $artwork,
        array $embedding,
        string $imageUrl,
        array $analysisResults
    ): void {
        $this->saveEmbeddings(
            modelName: "artworks",
            modelId: $artwork->id,
            embedding: $embedding,
            type: 'image',
            additionalData: [
                'description_generation_data' => [
                    'analysis_data' => $analysisResults['generated'],
                    'aic_description' => $analysisResults['original'] ?? null,
                ],
                'description' => $analysisResults['summarized'],
                'generated_at' => now()->toDateTimeString(),
                'image_url' => $imageUrl,
            ]
        );
    }

    protected function saveTextEmbeddings(
        Model $model,
        array $embedding,
        string $imageUrl = null,
        array $analysisResults = []
    ): void {
        $this->saveEmbeddings(
            modelName: app('Resources')->getEndpointForModel(get_class($model)),
            modelId: $model->id,
            embedding: $embedding,
            type: 'text',
            additionalData: array_filter([
                'description' => $analysisResults['summarized'] ?? $model->copy ?? null,
                'generated_at' => now()->toDateTimeString(),
                'image_url' => $imageUrl,
            ])
        );
    }
}
