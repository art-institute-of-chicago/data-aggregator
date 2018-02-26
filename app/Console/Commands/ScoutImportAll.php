<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScoutImportAll extends Command
{

    protected $signature = 'scout:import-all';

    protected $description = 'Import all models into the search index';


    public function handle()
    {

        ini_set("memory_limit", "-1");

        $models = app('Search')->getSearchableModels();

        foreach( $models as $model ) {

            $this->call("scout:import", ['model' => $model]);

        }

    }

}
