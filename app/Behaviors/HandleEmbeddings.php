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
    public function generateAndSaveArtworkEmbeddings(Artwork $artwork, bool $force = false): bool
    {
        try {
            // Skip artworks that already have alt text (check raw DB value to bypass the model's fallback accessor)
            if (!$force && !empty($artwork->getRawOriginal('alt_text'))) {
                $this->info(
                    "\nSkipping artwork ID {$artwork->id}: alt_text already present",
                    OutputInterface::VERBOSITY_VERBOSE
                );
                return false;
            }

            // Skip artworks without a primary image; image analysis and image embeddings require one.
            if (empty($artwork->getImageAttribute()?->netx_uuid)) {
                $this->info(
                    "\nSkipping artwork ID {$artwork->id}: no image available",
                    OutputInterface::VERBOSITY_VERBOSE
                );
                return false;
            }

            $this->info(
                "\nProcessing artwork: {$artwork->title} (ID: {$artwork->id})",
                OutputInterface::VERBOSITY_VERBOSE
            );

            $imageUrl = $this->buildImageUrl($artwork);
            $this->info("Image URL: {$imageUrl}", OutputInterface::VERBOSITY_VERBOSE);

            $analysisResults = $this->analyzeArtworkImage($artwork, $imageUrl);
            $this->processEmbeddings($artwork, $imageUrl, $analysisResults);

            return true;
        } catch (\Exception $e) {
            \Log::error('Error processing artwork:', [
                'artwork_id' => $artwork->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $this->error(
                "\nFailed processing artwork ID {$artwork->id}: {$e->getMessage()}"
            );

            throw $e;
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

    /**
     * Rate-limit requests across parallel processes using a shared temp file.
     * Returns after the required delay has elapsed.
     */
    private static function rateLimitWait(float $delaySeconds): void
    {
        $lockFile = sys_get_temp_dir() . '/alt-text-rate-limiter.lock';
        $fp = fopen($lockFile, 'c+');
        if (!$fp) {
            sleep(1);
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

    /**
     * Download an image and return it as a base64 data URI.
     * Azure cannot fetch URLs behind Cloudflare (www.artic.edu) server-side,
     * so we always send image bytes inline instead of a remote URL.
     */
    protected function fetchImageAsDataUri(string $imageUrl): string
    {
        $response = Http::retry(3, 1000, throw: false)->timeout(60)->get($imageUrl);

        if (!$response->successful()) {
            throw new Exception("Failed to download image ({$response->status()}): {$imageUrl}");
        }

        $mime = explode(';', $response->header('Content-Type') ?? 'image/jpeg')[0];

        return 'data:' . $mime . ';base64,' . base64_encode($response->body());
    }

    public function getLLMImageDescription(string $imageUrl, string $promptType = 'standard', ?string $context = null): array
    {
        $imageDataUri = $this->fetchImageAsDataUri($imageUrl);

        $promptText = AIPrompts::getAltTextPrompt($promptType);

        if (!empty($context)) {
            $promptText .= "\n\nReference-only catalogue metadata for this image:\n" . $context
                . "\n\nUse this only to fact-check your own visual assessment. Do NOT quote it verbatim, do NOT open your description with it, and do NOT mention the medium unless it is visually evident from the image itself. If you do mention the medium, translate it into plain language (e.g. \"oil painting\", never \"Oil on Beaverboard\").";
        }

        $systemContent = $promptType === 'artwork'
            ? 'You are an expert at analyzing images for accessibility and semantic search. You always respond with valid JSON.'
            : 'You are an expert at analyzing images for accessibility.';

        $requestBody = [
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemContent
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
                                'url' => $imageDataUri
                            ]
                        ]
                    ]
                ]
            ],
            'max_completion_tokens' => 2000,
            'temperature' => 0.2, // Low temperature: factual description, not creative writing
        ];

        if ($promptType === 'artwork') {
            $requestBody['response_format'] = ['type' => 'json_object'];
        }

        $maxRetries = 5;
        $baseDelay = 2; // seconds

        for ($attempt = 0; $attempt <= $maxRetries; $attempt++) {
            // Honor global rate limit if set
            $rpm = (int)config('azure.chat.rate_limit_rpm', 0);
            if ($rpm > 0) {
                self::rateLimitWait(60.0 / $rpm);
            }

            $response = Http::retry(3, 1000, throw: false)->withHeaders([
                'api-key' => config('azure.chat.key'),
                'Content-Type' => 'application/json'
            ])->post(config('azure.chat.endpoint') . '/openai/deployments/' . config('azure.chat.model') . '/chat/completions?api-version=' . config('azure.chat.version'), $requestBody);

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

                if ($promptType === 'artwork') {
                    $analysis = json_decode($messageContent, true);

                    if (json_last_error() !== JSON_ERROR_NONE) {
                        throw new Exception('Invalid JSON response from LLM');
                    }

                    if (empty($analysis['visual_description']) || empty($analysis['alt_text'])) {
                        throw new Exception('Invalid JSON response from LLM');
                    }

                    return [
                        'visual_description' => $analysis['visual_description'],
                        'alt_text' => $analysis['alt_text'],
                    ];
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

        // Get unified image analysis (visual description + alt text) in one call
        // Pass the catalogue medium so the model doesn't have to guess it
        $context = !empty($artwork->medium_display)
            ? 'Catalogue medium: ' . $artwork->medium_display
            : null;

        $analysis = $this->getLLMImageDescription($imageUrl, 'artwork', $context);
        $this->info("Generated image analysis", OutputInterface::VERBOSITY_VERBOSE);

        // Persist alt text to the artwork
        $artwork->alt_text = $analysis['alt_text'];
        $artwork->save();

        return [
            'generated' => $analysis,
            'original' => $artwork->description,
            'visual_description' => $analysis['visual_description'],
            'alt_text' => $analysis['alt_text'],
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
        $textEmbeddingArray = app('Embeddings')->getEmbeddings($analysisResults['visual_description']);

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
                'description' => $analysisResults['visual_description'],
                'alt_text' => $analysisResults['alt_text'] ?? null,
                'generated_at' => now()->toDateTimeString(),
                'image_url' => $imageUrl,
            ]
        );
    }

    protected function saveTextEmbeddings(
        Model $model,
        array $embedding,
        ?string $imageUrl = null,
        array $analysisResults = []
    ): void {
        $this->saveEmbeddings(
            modelName: app('Resources')->getEndpointForModel(get_class($model)),
            modelId: $model->id,
            embedding: $embedding,
            type: 'text',
            additionalData: array_filter([
                'description' => $analysisResults['visual_description'] ?? $model->copy ?? null,
                'generated_at' => now()->toDateTimeString(),
                'image_url' => $imageUrl,
            ])
        );
    }
}
