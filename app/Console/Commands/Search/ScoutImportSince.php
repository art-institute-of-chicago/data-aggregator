<?php

namespace App\Console\Commands\Search;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ScoutImportSince extends BaseCommand
{

    protected $signature = 'scout:import-since {datetime} {chunksize=20}';

    protected $description = 'Import all instances of all searchable models since an ISO 8601 datetime';

    public function handle()
    {
        ini_set('memory_limit', '-1');

        $chunksize = (int) $this->argument('chunksize');
        $datetime = new Carbon($this->argument('datetime'));
        $models = app('Search')->getSearchableModels();

        foreach ($models as $model) {
            $column = 'updated_at';

            if (Schema::hasColumn(with(new $model())->getTable(), 'source_modified_at')) {
                $column = 'source_modified_at';
            }

            $query = $model::whereDate($column, '>=', $datetime);

            $query->chunk($chunksize, function ($instances) use ($model) {

                $instances->searchable();

                foreach ($instances as $instance) {
                    $this->info('Imported ' . $instance->getKey() . ' of model ' . $model);
                }
            });
        }
    }
}
