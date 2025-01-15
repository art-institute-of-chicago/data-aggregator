<?php

namespace App\Console\Commands\AI;

use App\Console\Commands\BaseCommand;
use App\Services\EmbeddingService;
use App\Services\DescriptionService;
use App\Models\Collections\Artwork;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\OutputInterface;
use Carbon\Carbon;
use Exception;

class AnalyzeAllArtworks extends BaseCommand
{
    protected $signature = 'ai:analyze-all {--days=30 : Number of days before re-analyzing artwork} 
                                         {--start-id= : Start processing from this artwork ID}';
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
        $this->info($this->getAicLogo(), OutputInterface::VERBOSITY_VERBOSE);

        try {
            $daysThreshold = $this->option('days');
            $startId = $this->option('start-id');
            $cutoffDate = Carbon::now()->subDays($daysThreshold);

            $this->info("Starting artwork analysis...", OutputInterface::VERBOSITY_VERBOSE);
            $this->info(
                "Re-analyzing artworks last processed before: " . $cutoffDate->toDateTimeString(),
                OutputInterface::VERBOSITY_VERBOSE
            );

            if ($startId) {
                $this->info("Starting from artwork ID: " . $startId, OutputInterface::VERBOSITY_VERBOSE);
            }

            // Get total count first
            $total = $this->getArtworksCount($startId);

            if ($total === 0) {
                $this->info("No artworks need processing at this time.");
                return 0;
            }

            $this->info("Found {$total} artworks to process", OutputInterface::VERBOSITY_VERBOSE);
            $bar = $this->output->createProgressBar($total);

            // Define custom placeholder names
            $bar->setMessage('Processing artworks...');
            $bar->setMessage('Starting...', 'title');

            $bar->setFormat(
                " %message%\n" .
                " %current%/%max% [%bar%] %percent:3s%%\n" .
                " Current: %title%\n" .
                " Elapsed: %elapsed:6s%"
            );

            $processed = 0;
            $skipped = 0;
            $errors = [];
            $startTime = now();
            $chunkSize = 100; // Process 100 artworks at a time

            $query = $this->getArtworksToProcess($startId);
            $query->chunk($chunkSize, function ($artworks) use (
                &$processed,
                &$skipped,
                &$errors,
                $bar,
                $total
            ) {
                foreach ($artworks as $artwork) {
                    // Update the progress bar with current artwork title
                    $bar->setMessage($artwork->title ?? "Artwork #{$artwork->id}", 'title');

                    try {
                        $this->info(
                            "\nProcessing artwork: {$artwork->title} (ID: {$artwork->id})",
                            OutputInterface::VERBOSITY_VERBOSE
                        );

                        $imageUrl = $this->buildImageUrl($artwork);
                        $this->info("Image URL: {$imageUrl}", OutputInterface::VERBOSITY_VERBOSE);

                        $analysisResults = $this->analyzeImage($artwork, $imageUrl);
                        $this->processEmbeddings($artwork, $imageUrl, $analysisResults);

                        $processed++;
                    } catch (Exception $e) {
                        $errors[] = [
                            'id' => $artwork->id,
                            'title' => $artwork->title,
                            'error' => $e->getMessage()
                        ];

                        Log::error('Error processing artwork:', [
                            'artwork_id' => $artwork->id,
                            'message' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);

                        $this->error(
                            "\nFailed processing artwork ID {$artwork->id}: {$e->getMessage()}",
                            OutputInterface::VERBOSITY_VERBOSE
                        );
                    }

                    $bar->advance();

                    // Update progress message with current statistics
                    $completedPercentage = ($processed + count($errors)) / $total * 100;
                    $errorPercentage = count($errors) / $total * 100;
                    $bar->setMessage(sprintf(
                        'Progress: %.1f%% complete, %.1f%% failed',
                        $completedPercentage,
                        $errorPercentage
                    ));
                }
            });

            $bar->finish();
            $endTime = now();
            $duration = $endTime->diffForHumans($startTime, ['parts' => 2]);

            $this->newLine(2);
            $this->info("Analysis completed in {$duration}!", OutputInterface::VERBOSITY_VERBOSE);

            $this->table(
                ['Component', 'Status'],
                [
                    ['Total Artworks', $total],
                    ['Successfully Processed', sprintf("%d (%.1f%%)", $processed, $processed / $total * 100)],
                    ['Skipped', sprintf("%d (%.1f%%)", $skipped, $skipped / $total * 100)],
                    ['Failed', sprintf("%d (%.1f%%)", count($errors), count($errors) / $total * 100)]
                ]
            );

            if (count($errors) > 0) {
                $this->newLine();
                $this->error('Failed Artworks:');
                $this->table(
                    ['Artwork ID', 'Title', 'Error'],
                    $errors
                );
                $this->info("To resume processing from the last failed artwork, run:");
                $this->line("php artisan ai:analyze-all --start-id=" . end($errors)['id']);
            }

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

    protected function getArtworksCount(?int $startId = null): int
    {
        $query = Artwork::query();

        if ($startId) {
            $query->where('id', '>=', $startId);
        }

        return $query->count();
    }

    protected function getArtworksToProcess(?int $startId = null): \Illuminate\Database\Eloquent\Builder
    {
        $query = Artwork::query();

        if ($startId) {
            $query->where('id', '>=', $startId);
        }

        return $query->orderBy('id');
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
        $generatedDescription = $this->embeddingService->getImageDescription($imageUrl);
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
        $imageEmbeddingArray = $this->embeddingService->getImageEmbeddings($imageUrl);

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
        $textEmbeddingArray = $this->embeddingService->getEmbeddings($analysisResults['summarized']);

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
