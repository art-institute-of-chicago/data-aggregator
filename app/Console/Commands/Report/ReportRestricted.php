<?php

namespace App\Console\Commands\Report;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportRestricted extends BaseCommand
{

    protected $signature = 'report:restricted';

    protected $description = 'List all restricted fields and endpoints';

    public function handle()
    {
        $resources = collect(config('resources.outbound')['base'])
            ->filter(function($resource) {
                return isset($resource['endpoint'])
                    && !isset($resource['alias_of']);
            });

        $this->warn('Restricted endpoints:');

        $restrictedEndpoints = $resources
            ->where('is_restricted', true)
            ->pluck('endpoint')
            ->each(function($endpoint) {
                $this->info('    ' . $endpoint);
            });

        $this->warn('Restricted fields:');

        $resources
            ->whereNotIn('is_restricted', $restrictedEndpoints)
            ->each(function($resource) {
                $transformer = new $resource['transformer'](null, false);
                $restrictedFields = collect($transformer->getMappedFields())
                    ->map(function($item, $key) {
                        if ($item['is_restricted'] ?? false) {
                            return $key;
                        }
                    })
                    ->filter()
                    ->values();

                if ($restrictedFields->count() > 0) {
                    $this->info('    ' . $resource['endpoint']);
                    $restrictedFields->each(function($field) {
                        $this->info('        ' . $field);
                    });
                }
            });
    }
}
