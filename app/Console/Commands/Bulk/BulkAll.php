<?php

namespace App\Console\Commands\Bulk;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class BulkAll extends BaseCommand
{

    protected $signature = 'bulk:all {skip?}';

    protected $description = "Reset database and import everything";

    public function handle()
    {
        $shouldSkipTo = $this->argument('skip') ?? false;

        // Import all bulkable resources from compliant data services
        foreach (config('resources.inbound') as $source => $endpoints) {
            foreach ($endpoints as $endpoint => $resource) {
                dump("$source >> $endpoint");

                if ($shouldSkipTo && $source !== $shouldSkipTo) {
                    dump("Skipping...");
                    continue;
                }

                $this->call('bulk:import', [
                    'source' => $source,
                    'endpoint' => $endpoint,
                ]);

                $shouldSkipTo = false;
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

        // TODO: Use upserts for import:analytics
        $this->call('import:analytics');

        // TODO: Use bulking for import:images
        $this->call('import:images');
    }

}
