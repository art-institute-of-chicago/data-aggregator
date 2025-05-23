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
                " Current: %title% (ID: %id%)\n" .
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
                    $bar->setMessage($artwork->title, 'title');
                    $bar->setMessage($artwork->id, 'id');

                    try {
                        app('Embeddings')->generateAndSaveArtworkEmbeddngs($artwork, $this);
                        $processed++;
                    } catch (Exception $e) {
                        $errors[] = [
                            'id' => $artwork->id,
                            'title' => $artwork->title,
                            'error' => $e->getMessage()
                        ];
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
}
