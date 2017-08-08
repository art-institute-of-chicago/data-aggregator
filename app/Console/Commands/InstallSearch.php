<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

use App\Console\Helpers\Indexer;

class InstallSearch extends Command
{

    use Indexer;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:install {index? : The name of the index to create}';


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

        if (!$this->destroy($this->index))
        {

            $this->warn('Could not destroy index. Exiting.');

            return 0;

        }

        $params = config('elasticsearch.indexParams');

        $return = Elasticsearch::indices()->create($params);

        $this->info($this->done($return));

    }

}
