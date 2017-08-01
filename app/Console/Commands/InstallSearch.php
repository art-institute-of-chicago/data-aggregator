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
    protected $description = 'Set up the Search Service with data types and fields';

    protected $index = 'data_aggregator';

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

        $this->check();

        $params = [
            'index' => $this->index,
            'body' => [
                'mappings' =>
                \App\Models\Collections\Agent::instance()->elasticsearchMapping(),
            ]
        ];

        $return = Elasticsearch::indices()->create($params);
        
        if ($return['acknowledged'])
        {

            $this->info('Done!');

        }
        else
        {

            $this->info("There was an error: " .print_r($return, true));

        }

    }

    protected function check()
    {

        $params = [
            'index' => $this->index,
        ];        

        if (Elasticsearch::indices()->exists($params))
        {

            if ($this->confirm("The " .$this->index ." index already exists. Do you wish to delete and recreate it?")) {

                $return = Elasticsearch::indices()->delete($params);

            }

        }

    }

}
