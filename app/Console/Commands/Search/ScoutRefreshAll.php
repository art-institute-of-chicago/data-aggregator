<?php

namespace App\Console\Commands\Search;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ScoutRefreshAll extends BaseCommand
{

    protected $signature = 'scout:refresh-all';

    protected $description = 'Flush and re-import all models into the search index';

    public function handle()
    {
        $this->call('scout:flush-all');
        $this->call('scout:import-all');
    }

}
