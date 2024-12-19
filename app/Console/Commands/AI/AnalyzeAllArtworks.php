<?php

namespace App\Console\Commands\AI;

use App\Console\Commands\BaseCommand;
use App\Services\EmbeddingService;
use App\Services\DescriptionService;
use App\Models\Collections\Artwork;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;

class AnalyzeAllArtworks extends BaseCommand
{
    protected $signature = 'ai:analyze-all {--days=30 : Number of days before re-analyzing artwork}';
    protected $description = 'Analyze all artworks that need embeddings or haven\'t been analyzed recently';

    protected EmbeddingService $embeddingService;
    protected DescriptionService $descriptionService;

    public function __construct(
        EmbeddingService $embeddingService,
        DescriptionService $descriptionService
    ) {
        parent::__construct();
        $this->embeddingService = $embeddingService;
        $this->descriptionService = $descriptionService;
    }

    public function handle(): int
    {
        $this->getAicLogo();

        try {
            $daysThreshold = $this->option('days');
            $cutoffDate = Carbon::now()->subDays($daysThreshold);

            $this->info("Starting artwork analysis...");
            $this->info("Re-analyzing artworks last processed before: " . $cutoffDate->toDateTimeString());

            $artworks = $this->getArtworksToProcess($cutoffDate);
            $total = $artworks->count();
            
            if ($total === 0) {
                $this->info("No artworks need processing at this time.");
                return 0;
            }

            $this->info("Found {$total} artworks to process");
            $bar = $this->output->createProgressBar($total);
            
            $processed = 0;
            $skipped = 0;
            $errors = 0;

            foreach ($artworks as $artwork) {
                try {
                    if ($this->shouldProcessArtwork($artwork, $cutoffDate)) {
                        $this->processArtwork($artwork);
                        $processed++;
                    } else {
                        $skipped++;
                    }
                } catch (Exception $e) {
                    $errors++;
                    Log::error('Error processing artwork:', [
                        'artwork_id' => $artwork->id,
                        'message' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                }
                
                $bar->advance();
            }

            $bar->finish();
            
            $this->newLine(2);
            $this->table(
                ['Metric', 'Count'],
                [
                    ['Total Artworks', $total],
                    ['Processed', $processed],
                    ['Skipped', $skipped],
                    ['Errors', $errors]
                ]
            );

            return 0;
        } catch (Exception $e) {
            $this->error("Error: " . $e->getMessage());
            Log::error('Batch Analysis error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }
    }

    protected function getArtworksToProcess(Carbon $cutoffDate): \Illuminate\Database\Eloquent\Collection
    {
        return Artwork::query()
            ->whereHas('image')
            ->where(function ($query) use ($cutoffDate) {
                $query->whereDoesntHave('embeddings')
                    ->orWhereHas('embeddings', function ($q) use ($cutoffDate) {
                        $q->where('generated_at', '<', $cutoffDate);
                    });
            })
            ->get();
    }

    protected function shouldProcessArtwork(Artwork $artwork, Carbon $cutoffDate): bool
    {
        // Check if artwork has any embeddings
        if (!$artwork->embeddings()->exists()) {
            return true;
        }

        // Get the most recent embedding
        $latestEmbedding = $artwork->embeddings()
            ->latest('generated_at')
            ->first();

        // Process if the latest embedding is older than the cutoff date
        return $latestEmbedding && Carbon::parse($latestEmbedding->generated_at)->lt($cutoffDate);
    }

    protected function processArtwork(Artwork $artwork): void
    {
        $imageUrl = $this->buildImageUrl($artwork);
        $analysisResults = $this->analyzeImage($artwork, $imageUrl);
        $this->processEmbeddings($artwork, $imageUrl, $analysisResults);
    }

    protected function buildImageUrl(Artwork $artwork): string
    {
        if (empty($artwork->getImageAttribute()?->netx_uuid)) {
            throw new Exception("No image ID found for artwork {$artwork->id}");
        }

        return sprintf(
            'https://www.artic.edu/iiif/2/%s/full/full/0/default.jpg',
            $artwork->getImageAttribute()->netx_uuid
        );
    }

    protected function analyzeImage(Artwork $artwork, string $imageUrl): array
    {
        // Get image description
        $generatedDescription = $this->embeddingService->getImageDescription($imageUrl);

        // Get AIC description if available
        $aicDescription = $artwork->description;

        // Summarize descriptions
        $summarizedDescription = $this->descriptionService->summarizeImageDescription(
            $aicDescription,
            $generatedDescription
        );

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
        // Get and save image embeddings
        $imageEmbeddingArray = $this->embeddingService->getImageEmbeddings($imageUrl);
        $this->saveImageEmbeddings($artwork, $imageEmbeddingArray, $imageUrl, $analysisResults);

        // Get and save text embeddings
        $textEmbeddingArray = $this->embeddingService->getEmbeddings($analysisResults['summarized']);
        $this->saveTextEmbeddings($artwork, $textEmbeddingArray, $imageUrl, $analysisResults);
    }

    protected function saveImageEmbeddings(
        Artwork $artwork,
        array $embedding,
        string $imageUrl,
        array $analysisResults
    ): void {
        $this->embeddingService->saveEmbeddings(
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
        $this->embeddingService->saveEmbeddings(
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