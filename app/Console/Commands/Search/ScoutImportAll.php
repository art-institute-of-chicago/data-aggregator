<?php

namespace App\Console\Commands\Search;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ScoutImportAll extends BaseCommand
{

    protected $signature = 'scout:import-all';

    protected $description = 'Import all models into the search index';

    private $excludeModels = [
        // 'App\\Models\\Collections\\Artwork',
        // 'App\\Models\\Collections\\Image',
    ];

    public function handle()
    {
        ini_set('memory_limit', '-1');

        $models = app('Search')->getSearchableModels();
        $models = array_diff($models, $this->excludeModels);

        foreach ($models as $model) {
            $this->call('scout:import', ['model' => $model]);
        }
    }
}
