<?php

namespace App\Services;

use App\Models\Collections\Artwork;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Web\Vectors\TextEmbedding;
use App\Models\Web\Vectors\ImageEmbedding;
use Pgvector\Laravel\Vector;
use Exception;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Console\Output\OutputInterface;

class EmbeddingService
{
    public const CONFIDENCE_THRESHOLD_CAPTION = 0.7;
    public const CONFIDENCE_THRESHOLD_TAG = 0.9;

    protected string $connection = 'vectors';

    public function generateAndSaveArtworkEmbeddngs(Artwork $artwork, Command $consoleCommand)
    {
        try {
            $consoleCommand->info(
                "\nProcessing artwork: {$artwork->title} (ID: {$artwork->id})",
                OutputInterface::VERBOSITY_VERBOSE
            );

            $imageUrl = app('Embeddings')->buildImageUrl($artwork);
            $consoleCommand->info("Image URL: {$imageUrl}", OutputInterface::VERBOSITY_VERBOSE);

            $analysisResults = app('Embeddings')->analyzeImage($artwork, $imageUrl, $consoleCommand);
            app('Embeddings')->processEmbeddings($artwork, $imageUrl, $analysisResults, $consoleCommand);
        } catch (\Exception $e) {
            \Log::error('Error processing artwork:', [
                'artwork_id' => $artwork->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $consoleCommand->error(
                "\nFailed processing artwork ID {$artwork->id}: {$e->getMessage()}"
            );
        }
    }

    public function getEmbeddings(string $input): ?array
    {
        return Cache::remember(
            "embedding:search:" . md5($input),
            now()->addDays(7),
            function () use ($input) {
                \Log::info('making call to Azure');
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'api-key' => config('azure.embedding.key'),
                ])->post(config('azure.embedding.endpoint'), [
                    'input' => [$input],
                    'model' => 'text-embedding-ada-002'
                ]);

                if ($response->successful()) {
                    return $response->json()['data'][0]['embedding'] ?? null;
                }

                throw new Exception('Failed to get embeddings: ' . $response->json()['error'] ?? 'Unknown error');
            }
        );
    }

    public function getImageEmbeddings(string $imageUrl): ?array
    {
        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => config('azure.image_embedding.key')
        ])->post(config('azure.image_embedding.endpoint'), [
            'url' => $imageUrl
        ]);

        if ($response->successful()) {
            return $response->json()['vector'] ?? null;
        }

        throw new Exception('Failed to get image embeddings: ' . $response->json()['error'] ?? 'Unknown error');
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

        $result = $embeddingModel::on($this->connection)
            ->updateOrCreate(
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

        $imageEmbedding = ImageEmbedding::on($this->connection)
            ->updateOrCreate(
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
            $textEmbedding = $this->getEmbeddings($descriptionText);
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

        throw new Exception('Failed to get image description: ' . $response->json()['message'] ?? 'Unknown error');
    }

    public function normalizeQuery(string $input): string
    {
        if (empty($input)) {
            throw new Exception('No valid input given');
        }

        $prompt = <<<EOT
        You are an AI designed to help with semantic search queries. Given a natural language query, your task is to normalize the input by simplifying the language, removing unnecessary details, and retaining only the core meaning. The goal is to ensure that the query can be efficiently converted into a vector for search purposes. Please return the normalized query in a clear, concise form.

        Example 1:
        Input: "Can you show me the documents related to machine learning applications in healthcare?"
        Output: "machine learning applications in healthcare"

        Example 2:
        Input: "What are the best practices for setting up a scalable cloud infrastructure?"
        Output: "best practices scalable cloud infrastructure"

        Now, normalize the following query: "{$input}"
        EOT;

        return $this->getCompletions($prompt);
    }

    public function getCompletions(string $input): string
    {
        $response = Http::withHeaders([
            'api-key' => config('azure.completion.key')
        ])->post(config('azure.completion.endpoint'), [
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $input
                ]
            ]
        ]);

        if ($response->successful()) {
            return $response->json()['choices'][0]['message']['content'] ?? '';
        }

        throw new Exception('Failed to get completions: ' . $response->json()['error'] ?? 'Unknown error');
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

    public function analyzeImage(Artwork $artwork, string $imageUrl, Command $consoleCommand): array
    {
        $consoleCommand->info("\nPerforming image analysis...", OutputInterface::VERBOSITY_VERBOSE);

        // Get image description
        $generatedDescription = $this->getImageDescription($imageUrl);
        $consoleCommand->info("Generated base description", OutputInterface::VERBOSITY_VERBOSE);

        // Get AIC description if available
        $aicDescription = $artwork->description;

        // Summarize descriptions
        $summarizedDescription = app('Descriptions')->summarizeImageDescription(
            $aicDescription,
            $generatedDescription
        );
        $consoleCommand->info("Generated summarized description", OutputInterface::VERBOSITY_VERBOSE);

        return [
            'generated' => $generatedDescription,
            'original' => $aicDescription,
            'summarized' => $summarizedDescription,
        ];
    }

    public function processEmbeddings(
        Artwork $artwork,
        string $imageUrl,
        array $analysisResults,
        Command $consoleCommand
    ): void {
        $consoleCommand->info("\nProcessing embeddings...", OutputInterface::VERBOSITY_VERBOSE);

        // Get and save image embeddings
        $imageEmbeddingArray = $this->getImageEmbeddings($imageUrl);

        $consoleCommand->info(
            "Image embedding response type: " . gettype($imageEmbeddingArray),
            OutputInterface::VERBOSITY_VERBOSE
        );

        if (is_array($imageEmbeddingArray)) {
            $consoleCommand->info(
                "Image embedding array count: " . count($imageEmbeddingArray),
                OutputInterface::VERBOSITY_VERBOSE
            );
        }

        try {
            $this->saveImageEmbeddings($artwork, $imageEmbeddingArray, $imageUrl, $analysisResults);
            $consoleCommand->info("Saved image embeddings", OutputInterface::VERBOSITY_VERBOSE);
        } catch (\Exception $e) {
            throw new Exception("Failed to save image embeddings: " . $e->getMessage());
        }

        // Get and save text embeddings
        $consoleCommand->info("\nGetting text embeddings...", OutputInterface::VERBOSITY_VERBOSE);
        $textEmbeddingArray = $this->getEmbeddings($analysisResults['summarized']);

        try {
            $this->saveTextEmbeddings($artwork, $textEmbeddingArray, $imageUrl, $analysisResults);
            $consoleCommand->info("Saved text embeddings", OutputInterface::VERBOSITY_VERBOSE);
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
        Artwork $artwork,
        array $embedding,
        string $imageUrl,
        array $analysisResults
    ): void {
        $this->saveEmbeddings(
            modelName: "artworks",
            modelId: $artwork->id,
            embedding: $embedding,
            type: 'text',
            additionalData: [
                'description' => $analysisResults['summarized'],
                'generated_at' => now()->toDateTimeString(),
                'image_url' => $imageUrl,
            ]
        );
    }
}
