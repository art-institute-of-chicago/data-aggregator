<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScoutRefreshAll extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:refresh-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush and re-import all models into the search index';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->call("scout:flush-all");
        $this->call("scout:import-all");

    }

}
