<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScoutRefresh extends Command
{

    protected $signature = 'scout:refresh
                            {model}';

    protected $description = 'Flush and re-import the given model into the search index';


    public function handle()
    {

        $class = $this->argument('model');

        $this->call("scout:flush", ['model' => $class]);
        $this->call("scout:import", ['model' => $class]);

    }

}
