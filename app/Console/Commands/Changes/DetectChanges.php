<?php

namespace App\Console\Commands\Changes;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;
use App\Services\ChangeTracker;
use Carbon\Carbon;

class DetectChanges extends BaseCommand
{
    protected $signature = 'changes:detect
                            {endpoint? : Only check this resource, e.g. `artworks`}
                            {--since= : Check records updated since this date, instead of since the last successful run}
                            {--baseline : Write snapshots without logging any changes}';

    protected $description = 'Log changes to the public API fields of resources that have `track_changes` enabled';

    protected $chunkSize = 100;

    public function handle()
    {
        ini_set('memory_limit', '-1');

        $endpoints = $this->argument('endpoint')
            ? [$this->argument('endpoint')]
            : app('Resources')->getTrackedEndpoints();

        foreach ($endpoints as $endpoint) {
            if (!app('Resources')->isTrackingChanges($endpoint)) {
                $this->error('Resource `' . $endpoint . '` does not have `track_changes` enabled');

                return 1;
            }

            $this->detect($endpoint);
        }

        return 0;
    }

    private function detect(string $endpoint)
    {
        // Track the last successful run per resource, using the same table as the import commands
        $command = \App\Command::firstOrNew(['command' => $this->getName() . ' ' . $endpoint]);
        $command->last_attempt_at = Carbon::now();
        $command->save();

        $detectedAt = $command->last_attempt_at;
        $tracker = new ChangeTracker($endpoint);

        // Until a run completes, every record without a snapshot would look new, so just record a starting point.
        // Checking for a completed run, rather than for any snapshots, lets an interrupted baseline resume.
        $isBaseline = $this->option('baseline') || $command->last_success_at->eq(\App\Command::never());

        $since = $this->option('since') ? Carbon::parse($this->option('since')) : $command->last_success_at;

        // Overlap with the previous run a bit. Re-checking an unchanged record is a no-op.
        $since = $since->copy()->subMinutes(5);

        $modelClass = app('Resources')->getModelForEndpoint($endpoint);
        $query = $modelClass::query()->where('updated_at', '>=', $since);

        $this->info(($isBaseline ? 'Baselining ' : 'Checking ') . $endpoint . ' updated since ' . $since->toIso8601String());

        $bar = $this->output->createProgressBar($query->count());
        $changeCount = 0;

        $query->chunkById($this->chunkSize, function ($items) use ($tracker, $detectedAt, $isBaseline, $bar, &$changeCount) {
            $changeCount += $tracker->track($items, $detectedAt, $isBaseline);
            $bar->advance($items->count());
        });

        $bar->finish();
        $this->newLine();

        $deletedCount = $isBaseline ? 0 : $tracker->trackDeletions($detectedAt);

        $this->info('Logged ' . $changeCount . ' change(s) and ' . $deletedCount . ' deletion(s) for ' . $endpoint);

        $command->last_success_at = $command->last_attempt_at;
        $command->save();
    }
}
