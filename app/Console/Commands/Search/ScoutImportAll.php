<?php

namespace App\Console\Commands\Search;

use Illuminate\Support\Facades\Config;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ScoutImportAll extends BaseCommand
{

    protected $signature = 'scout:import-all
                            {prefix? : Prefix for index(es) for versioning}';

    protected $description = 'Import all models into the search index';

    private $excludeModels = [
        // 'App\\Models\\Collections\\Artwork',
        // 'App\\Models\\Collections\\Image',
    ];

    public function handle()
    {
        if ($this->argument('prefix')) {
            Config::set('scout.elasticsearch.index', $this->argument('prefix'));
        }

        ini_set('memory_limit', '-1');

        $models = app('Search')->getSearchableModels();
        $models = array_diff($models, $this->excludeModels);

        foreach ($models as $model) {
            $this->call('scout:import', ['model' => $model]);
        }
    }
}
