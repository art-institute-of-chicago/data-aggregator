<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

class InstallSearch extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the Search Service index with data types and fields';


    /**
     * The name of the index to create.
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
        $this->index = env('ELASTICSEARCH_INDEX', 'data_aggregator:v1');
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->check();

        $params = config('elasticsearch.indexParams');

        $return = Elasticsearch::indices()->create($params);

        $this->info($this->done($return));
    }


    /**
     * Check if the index already exists. If it exists, the user is prompted to delete it.
     */
    protected function check()
    {

        $params = [
            'index' => $this->index,
        ];        

        if (Elasticsearch::indices()->exists($params))
        {

            if ($this->confirm("The " .$this->index ." index already exists. Do you wish to delete it?")) {

                $return = Elasticsearch::indices()->delete($params);

            }

        }

    }


    /**
     * Determine message to output after the index is created.
     *
     * @param array  $return
     */
    protected function done($return = [])
    {

        if ($return['acknowledged'])
        {

            return 'Done!';

        }

        return "There was an error: " .print_r($return, true);

    }

}
