<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScoutImportOne extends Command
{

    protected $signature = 'scout:import-one
                            {model}
                            {id}';

    protected $description = 'Import one instance of a model into the search index';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $id = $this->argument('id');
        $class = $this->argument('model');

        $model = new $class;

        $model::find( $id )->searchable();

        $this->info("Imported #${id} of model ${class}");

    }
}
