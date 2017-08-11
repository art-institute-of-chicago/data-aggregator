<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

use App\Console\Helpers\Indexer;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ReindexSearch extends Command
{

    use Indexer;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex
                            {source : The name of the index to copy documents from}
                            {dest? : The name of the index to copy documents to}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy documents from one index to another';


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

        $source = $this->argument('source');
        $dest = env('ELASTICSEARCH_INDEX', 'data_aggregator_test');

        if ($this->argument('dest'))
        {

            $dest = $this->argument('dest');

        }

        $params = [
            'wait_for_completion' => false,
            'body' => [
                'source' => [
                    'index' => $source,
                    'size' => 100,
                ],
                'dest' => [
                    'index' => $dest,
                ],
            ],
        ];

        $return = Elasticsearch::reindex($params);

        $this->info('Reindex has started. You can monitor the process here: ' .$this->baseUrl() .'/_tasks/' .$return['task']);

    }

}
