<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

class UninstallSearch extends Command
{

    protected $signature = 'search:uninstall {index? : The name of the index to delete}';

    protected $description = 'Tear down the Search Service index';

    /**
     * The name of the index to delete.
     *
     * @var string
     */
    protected $index;


    public function __construct()
    {

        parent::__construct();
        $this->index = env('ELASTICSEARCH_INDEX', 'data_aggregator_test');

    }


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
