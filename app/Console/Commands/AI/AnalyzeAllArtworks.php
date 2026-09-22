<?php

namespace App\Console\Commands\AI;

use App\Behaviors\HandleEmbeddings;
use App\Console\Commands\BaseCommand;
use App\Services\DescriptionService;
use App\Models\Collections\Artwork;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\StreamOutput;
use Carbon\Carbon;
use Exception;

class AnalyzeAllArtworks extends BaseCommand
{
    use HandleEmbeddings;

    protected $signature = 'ai:analyze-all-artworks {ids?* : One or more specific artwork IDs to process}
                                                    {--days=30 : Number of days before re-analyzing artwork}
                                                    {--start-id= : Start processing from this artwork ID}
                                                    {--force : Regenerate even if the artwork already has alt text}
                                                    {--concurrency=1 : Number of parallel worker processes}';
    protected $description = 'Analyze all artworks that need embeddings or haven\'t been analyzed recently';

    protected DescriptionService $descriptionService;

    private array $childPids = [];
    private ?string $statsDir = null;

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
            $ids = array_map('intval', $this->argument('ids') ?? []);
            $ids = !empty($ids) ? $ids : null;
            $daysThreshold = $this->option('days');
            $startId = $this->option('start-id');
            $cutoffDate = Carbon::now()->subDays($daysThreshold);

            $this->info("Starting artwork analysis...", OutputInterface::VERBOSITY_VERBOSE);
            $this->info(
                "Re-analyzing artworks last processed before: " . $cutoffDate->toDateTimeString(),
                OutputInterface::VERBOSITY_VERBOSE
            );

            if ($ids) {
                $this->info("Processing " . count($ids) . " specific artwork ID(s)", OutputInterface::VERBOSITY_VERBOSE);
            }

            if ($startId) {
                $this->info("Starting from artwork ID: " . $startId, OutputInterface::VERBOSITY_VERBOSE);
            }

            // Get total count first
            $force = (bool) $this->option('force');

            $total = $this->getArtworksCount($startId, $force, $ids);

            if ($total === 0) {
                $this->info("No artworks need processing at this time.");
                return 0;
            }

            $this->info("Found {$total} artworks to process", OutputInterface::VERBOSITY_VERBOSE);

            $processed = 0;
            $skipped = 0;
            $errors = [];
            $startTime = now();

            $concurrency = max(1, (int) $this->option('concurrency'));

            if ($concurrency > 1 && !function_exists('pcntl_fork')) {
                $this->warn('pcntl extension not available — falling back to single process.');
                $concurrency = 1;
            }

            if ($concurrency > 1) {
                [$processed, $skipped, $errors] = $this->runParallel($startId, $force, $total, $concurrency, $ids);
            } else {
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

                $chunkSize = 100; // Process 100 artworks at a time

                $query = $this->getArtworksToProcess($startId, $force, $ids);
                $query->chunk($chunkSize, function ($artworks) use (
                    &$processed,
                    &$skipped,
                    &$errors,
                    $bar,
                    $total,
                    $force
                ) {
                    foreach ($artworks as $artwork) {
                        // Update the progress bar with current artwork title
                        $bar->setMessage($artwork->title, 'title');
                        $bar->setMessage($artwork->id, 'id');

                        try {
                            $result = $this->generateAndSaveArtworkEmbeddings($artwork, $force);
                            $result ? $processed++ : $skipped++;
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
            }

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

    /**
     * Fork N worker processes, each handling an even slice of the ID list.
     * Workers stream stats to JSON files; the parent polls them for progress.
     * Returns [processed, skipped, errors].
     */
    protected function runParallel(?int $startId, bool $force, int $total, int $concurrency, ?array $onlyIds = null): array
    {
        $ids = $this->getArtworksToProcess($startId, $force, $onlyIds)->pluck('id');
        $chunks = $ids->chunk(max(1, (int) ceil($ids->count() / $concurrency)));

        $this->statsDir = storage_path('app/analyze-' . now()->format('Ymd-His') . '-' . getmypid());
        mkdir($this->statsDir, 0755, true);

        $this->info("⚡ Parallel mode: " . count($chunks) . " workers, {$ids->count()} artworks");
        $this->info("Worker logs: {$this->statsDir}");

        $this->setupSignalHandler();

        $pending = 0;

        foreach ($chunks as $i => $chunk) {
            $pid = pcntl_fork();

            if ($pid === -1) {
                $this->error('Failed to fork worker ' . ($i + 1));
                continue;
            }

            if ($pid === 0) {
                // Child process: route all command output to a per-worker log file
                $logStream = fopen("{$this->statsDir}/worker-" . ($i + 1) . '.log', 'w');
                $this->setOutput(new OutputStyle(
                    new ArrayInput([]),
                    new StreamOutput($logStream, StreamOutput::VERBOSITY_DEBUG, false)
                ));
                $this->reconnectDb();

                $stats = $this->processIdList($chunk->all(), $force, "{$this->statsDir}/worker-{$i}.json");
                file_put_contents("{$this->statsDir}/worker-{$i}.json", json_encode($stats));
                exit(0);
            }

            $this->childPids[$pid] = true;
            $pending++;
            $this->info('  Worker ' . ($i + 1) . ": PID {$pid} — {$chunk->count()} items", OutputInterface::VERBOSITY_VERBOSE);
        }

        if ($pending === 0) {
            throw new Exception('Could not fork any worker processes.');
        }

        // Monitor workers, rendering aggregate progress from stats files
        while ($pending > 0) {
            $result = pcntl_wait($status, WNOHANG);

            if ($result > 0) {
                unset($this->childPids[$result]);
                $pending--;
                continue;
            }

            $this->renderParallelProgress($total);
            usleep(500000);
        }

        $this->renderParallelProgress($total);

        // Aggregate final stats
        $processed = 0;
        $skipped = 0;
        $errors = [];

        foreach (glob("{$this->statsDir}/worker-*.json") ?: [] as $file) {
            $stats = json_decode(file_get_contents($file), true);

            if (!$stats) {
                continue;
            }

            $processed += $stats['processed'] ?? 0;
            $skipped += $stats['skipped'] ?? 0;
            $errors = array_merge($errors, $stats['errors'] ?? []);
        }

        return [$processed, $skipped, $errors];
    }

    /**
     * Process a list of artwork IDs (runs inside a forked worker).
     * Stats are written periodically so the parent can render progress.
     */
    protected function processIdList(array $ids, bool $force, string $statsPath): array
    {
        $processed = 0;
        $skipped = 0;
        $failed = 0;
        $errors = [];
        $i = 0;

        foreach ($ids as $id) {
            $i++;
            $artwork = Artwork::find($id);

            if (!$artwork) {
                $skipped++;
            } else {
                try {
                    $result = $this->generateAndSaveArtworkEmbeddings($artwork, $force);
                    $result ? $processed++ : $skipped++;
                } catch (Exception $e) {
                    $failed++;

                    // Cap stored error details to keep stats files small
                    if (count($errors) < 500) {
                        $errors[] = [
                            'id' => $id,
                            'title' => $artwork->title,
                            'error' => $e->getMessage()
                        ];
                    }
                }
            }

            if ($i % 5 === 0) {
                $this->writeStats($statsPath, $processed, $skipped, $failed, $errors);
            }
        }

        return [
            'processed' => $processed,
            'skipped' => $skipped,
            'failed' => $failed,
            'errors' => $errors,
        ];
    }

    protected function writeStats(string $path, int $processed, int $skipped, int $failed, array $errors): void
    {
        file_put_contents($path, json_encode([
            'processed' => $processed,
            'skipped' => $skipped,
            'failed' => $failed,
            'errors' => $errors,
        ]));
    }

    protected function renderParallelProgress(int $total): void
    {
        $done = 0;
        $failed = 0;

        foreach (glob("{$this->statsDir}/worker-*.json") ?: [] as $file) {
            $stats = json_decode(file_get_contents($file), true);

            if (!$stats) {
                continue;
            }

            $failed += $stats['failed'] ?? 0;
            $done += ($stats['processed'] ?? 0) + ($stats['skipped'] ?? 0) + ($stats['failed'] ?? 0);
        }

        $this->output->write(sprintf(
            "\r<info>Progress:</info> %d/%d (%.1f%%) — %d failed   ",
            $done,
            $total,
            $total > 0 ? $done / $total * 100 : 0,
            $failed
        ));
    }

    protected function reconnectDb(): void
    {
        DB::purge();
        DB::reconnect();
    }

    protected function setupSignalHandler(): void
    {
        $handler = function (int $signo) {
            foreach (array_keys($this->childPids) as $pid) {
                posix_kill($pid, SIGTERM);
            }
            $this->warn("\n⚠️ Interrupted. Workers terminated.");
            exit(1);
        };

        pcntl_async_signals(true);
        pcntl_signal(SIGINT, $handler);
        pcntl_signal(SIGTERM, $handler);
    }

    protected function getArtworksCount(?int $startId = null, bool $force = false, ?array $ids = null): int
    {
        return $this->buildQuery($startId, $force, $ids)->count();
    }

    protected function getArtworksToProcess(?int $startId = null, bool $force = false, ?array $ids = null): \Illuminate\Database\Eloquent\Builder
    {
        return $this->buildQuery($startId, $force, $ids)->orderBy('id');
    }

    protected function buildQuery(?int $startId = null, bool $force = false, ?array $ids = null): \Illuminate\Database\Eloquent\Builder
    {
        $query = Artwork::query();

        if (!$force) {
            $query->where(fn ($q) => $q->whereNull('alt_text')->orWhere('alt_text', ''));
        }

        if ($ids) {
            $query->whereIn('id', $ids);
        }

        if ($startId) {
            $query->where('id', '>=', $startId);
        }

        return $query;
    }
}
