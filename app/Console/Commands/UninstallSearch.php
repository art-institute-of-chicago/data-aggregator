<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

class UninstallSearch extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:uninstall {index? : The name of the index to delete}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tear down the Search Service index';


    /**
     * The name of the index to delete.
     *
     * @var string
     */
    protected $index;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
        $this->index = env('ELASTICSEARCH_INDEX', 'data_aggregator_test');

    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        if ($this->argument('index'))
        {

            $this->index = $this->argument('index');

        }

        $params = [
            'index' => $this->index,
        ];

        if (Elasticsearch::indices()->exists($params))
        {

            $return = Elasticsearch::indices()->delete($params);

        }

    }

}
