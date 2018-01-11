<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScoutFlushAll extends Command
{

    protected $signature = 'scout:flush-all';

    protected $description = 'Remove all models from search index';


    public function handle()
    {

        $models = app('Search')->getSearchableModels();

        foreach( $models as $model ) {

            $this->call("scout:flush", ['model' => $model]);

        }

    }

}
