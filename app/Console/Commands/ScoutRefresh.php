<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScoutRefresh extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:refresh
                            {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush and re-import the given model into the search index';

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

        $class = $this->argument('model');

        $this->call("scout:flush", ['model' => $class]);
        $this->call("scout:import", ['model' => $class]);

    }

}
