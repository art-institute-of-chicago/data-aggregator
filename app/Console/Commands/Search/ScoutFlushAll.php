<?php

namespace App\Console\Commands\Search;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ScoutFlushAll extends BaseCommand
{

    protected $signature = 'scout:flush-all';

    protected $description = 'Remove all models from search index';

    public function handle()
    {

        $models = app('Search')->getSearchableModels();

        foreach ($models as $model) {

            $this->call('scout:flush', ['model' => $model]);

        }

    }

}
