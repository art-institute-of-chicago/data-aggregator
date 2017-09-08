<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScoutRefreshAll extends Command
{

    protected $signature = 'scout:refresh-all';

    protected $description = 'Flush and re-import all models into the search index';


    public function handle()
    {

        $this->call("scout:flush-all");
        $this->call("scout:import-all");

    }

}
