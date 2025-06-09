<?php

namespace App\Behaviors;

use App\Models\Collections\Artwork;
use Illuminate\Support\Facades\Http;
use App\Models\Web\Vectors\TextEmbedding;
use App\Models\Web\Vectors\ImageEmbedding;
use Pgvector\Laravel\Vector;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\OutputInterface;

trait HandleEmbeddings
{
    public const CONFIDENCE_THRESHOLD_CAPTION = 0.7;
    public const CONFIDENCE_THRESHOLD_TAG = 0.9;

    public function generateAndSaveArtworkEmbeddngs(Artwork $artwork): void
    {
        try {
            $this->info(
                "\nProcessing artwork: {$artwork->title} (ID: {$artwork->id})",
                OutputInterface::VERBOSITY_VERBOSE
            );

            $imageUrl = $this->buildImageUrl($artwork);
            $this->info("Image URL: {$imageUrl}", OutputInterface::VERBOSITY_VERBOSE);

            $analysisResults = $this->analyzeImage($artwork, $imageUrl);
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

    public function analyzeImage(Artwork $artwork, string $imageUrl): array
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
