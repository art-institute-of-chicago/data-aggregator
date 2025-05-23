<?php

namespace App\Console\Commands\AI;

use App\Behaviors\HandleEmbeddings;
use App\Console\Commands\BaseCommand;
use App\Services\DescriptionService;
use App\Models\Collections\Artwork;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\OutputInterface;
use Exception;

class AnalyzeImage extends BaseCommand
{
    use HandleEmbeddings;

    protected $signature = 'ai:analyze {id? : Artwork ID to analyze}';
    protected $description = 'Analyze an artwork using AI for descriptions and embeddings';

    protected DescriptionService $descriptionService;

    public function __construct(
        DescriptionService $descriptionService
    ) {
        parent::__construct();
        $this->descriptionService = $descriptionService;
    }

    public function handle(): int
    {
        $this->info($this->getAicLogo(), OutputInterface::VERBOSITY_VERBOSE);

        try {
            $artwork = $this->getArtwork();
            $imageUrl = $this->buildImageUrl($artwork);

            $this->info("Analyzing artwork: {$artwork->title}", OutputInterface::VERBOSITY_VERBOSE);
            $this->info("Image URL: {$imageUrl}", OutputInterface::VERBOSITY_VERBOSE);

            // Get and save image analysis
            $analysisResults = $this->analyzeImage($artwork, $imageUrl);

            // Process and save embeddings
            $this->processEmbeddings($artwork, $imageUrl, $analysisResults);

            $this->info("\nAnalysis completed successfully!", OutputInterface::VERBOSITY_VERBOSE);
            $this->table(
                ['Component', 'Status'],
                [
                    ['Image Analysis', '✓'],
                    ['Image Embeddings', '✓'],
                    ['Text Embeddings', '✓'],
                    ['Description', '✓']
                ]
            );

            return 0;
        } catch (Exception $e) {
            $this->error("Error: " . $e->getMessage());
            Log::error('AI Analysis error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }
    }

    protected function getArtwork(): Artwork
    {
        $id = $this->argument('id') ?? $this->ask('What is the datahub_id of the artwork to process?');

        $artwork = Artwork::find($id);
        if (!$artwork) {
            throw new Exception("Artwork with ID {$id} not found.");
        }

        return $artwork;
    }

    protected function buildImageUrl(Artwork $artwork): string
    {
        if (empty($artwork->getImageAttribute()?->netx_uuid)) {
            throw new Exception("No image ID found for artwork {$artwork->id}");
        }

        return sprintf(
            config('aic.config_documentation.iiif_url') . '/%s/full/full/0/default.jpg',
            $artwork->getImageAttribute()->netx_uuid
        );
    }

    protected function analyzeImage(Artwork $artwork, string $imageUrl): array
    {
        $this->info("\nPerforming image analysis...", OutputInterface::VERBOSITY_VERBOSE);

        // Get image description
        $generatedDescription = $this->getImageDescription($imageUrl);
        $this->info("Generated base description", OutputInterface::VERBOSITY_VERBOSE);

        // Get AIC description if available
        $aicDescription = $artwork->description;

        // Summarize descriptions
        $summarizedDescription = $this->descriptionService->summarizeImageDescription(
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

    protected function processEmbeddings(
        Artwork $artwork,
        string $imageUrl,
        array $analysisResults
    ): void {
        $this->info("\nProcessing embeddings...", OutputInterface::VERBOSITY_VERBOSE);

        // Get and save image embeddings
        $imageEmbeddingArray = app('Embeddings')->getImageEmbeddings($imageUrl);

        $this->info("Image embedding response type: " . gettype($imageEmbeddingArray), OutputInterface::VERBOSITY_VERBOSE);
        if (is_array($imageEmbeddingArray)) {
            $this->info("Image embedding array count: " . count($imageEmbeddingArray), OutputInterface::VERBOSITY_VERBOSE);
        }

        try {
            // Pass array directly to saveEmbeddings
            $this->saveImageEmbeddings($artwork, $imageEmbeddingArray, $imageUrl, $analysisResults);
            $this->info("Saved image embeddings", OutputInterface::VERBOSITY_VERBOSE);
        } catch (\Exception $e) {
            throw new Exception("Failed to save image embeddings: " . $e->getMessage());
        }

        // Get and save text embeddings
        $this->info("\nGetting text embeddings...", OutputInterface::VERBOSITY_VERBOSE);
        $textEmbeddingArray = app('Embeddings')->getEmbeddings($analysisResults['summarized']);

        try {
            // Pass array directly to saveEmbeddings
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
