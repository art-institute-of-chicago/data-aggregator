<?php

namespace App\Console\Commands\Bulk;

use Carbon\Carbon;
use App\Command;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class BulkAll extends BaseCommand
{

    protected $signature = 'bulk:all {skip-to-source?} {skip-to-endpoint?} {--at=}';

    protected $description = "Reset database and import everything";

    private $startedAt;

    public function handle()
    {
        if ($this->hasOption('at') && !empty($this->option('at'))) {
            try {
                $this->startedAt = Carbon::parse($this->option('at'));
            } catch (\Exception $e) {
                echo 'Cannot parse date in --at option';
            }
        }

        $shouldSkipToSource = $this->argument('skip-to-source') ?? false;
        $shouldSkipToEndpoint = $this->argument('skip-to-endpoint') ?? false;

        // Import all bulkable resources from compliant data services
        foreach (config('resources.inbound') as $source => $endpoints) {

            foreach ($endpoints as $endpoint => $resource) {
                dump("$source >> $endpoint");

                if ((
                    $shouldSkipToSource && $source !== $shouldSkipToSource
                ) || (
                    $shouldSkipToEndpoint && $endpoint !== $shouldSkipToEndpoint
                )) {
                    dump("Skipping...");
                    continue;
                }

                if ($resource['exclude_from_import'] ?? false) {
                    dump("Skipping from config...");
                    continue;
                }

                $this->call('bulk:import', [
                    'source' => $source,
                    'endpoint' => $endpoint,
                ]);

                $shouldSkipToSource = false;
                $shouldSkipToEndpoint = false;
            }
        }

        // EventOccurrence is not included in import:web to avoid duplication
        $this->call('import:web-full', ['--yes' => 'default', 'endpoint' => 'event-occurrences']);

        // Run scout now for faster uptime
        $this->call('scout:import-all');

        // Import non-standard data
        $this->call('import:mobile');
        $this->call('import:sites', ['--yes' => 'default']);
        $this->call('import:ulan');
        $this->call('import:digital-labels');

        // TODO: Use upserts for import:analytics
        $this->call('import:analytics');

        // Spoof \App\Command records for partial imports
        foreach ([
            'import:collections',
            'import:assets',
            'import:events',
            'import:dsc',
            'import:mobile',
            'import:library',
            'import:archive',
            'import:sites',
            'import:ulan',
            'import:products',
            'import:images',
            'import:analytics',
            'import:web',
            'delete:assets',
            'delete:collections',
        ] as $commandName) {
            $command = Command::where('command', $commandName) ?: new Command([
                'title' => $commandName,
            ]);

            $command->last_attempt_at = $this->startedAt ?? $this->command->last_attempt_at;
            $command->last_success_at = $this->startedAt ?? $this->command->last_attempt_at;

            $command->save();
        }
    }

}
