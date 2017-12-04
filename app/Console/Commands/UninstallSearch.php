<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

use App\Console\Helpers\Indexer;

class UninstallSearch extends Command
{

    use Indexer;

    protected $signature = 'search:uninstall {index? : The group of indexes to delete} {--y|yes : Answer "yes" to all prompts confirming to delete index}';

    protected $description = 'Tear down the Search Service indexes';

    /**
     * The prefix of the indexes to delete.
     *
     * @var string
     */
    protected $index;


    public function __construct()
    {

        parent::__construct();
        $this->index = env('ELASTICSEARCH_INDEX');

    }


    public function handle()
    {

        if ($this->argument('index'))
        {

            $this->index = $this->argument('index');

        }

        if (!$this->option('yes') && !$this->confirm("This will delete all indexes that are a part of the " .$this->index ." alias. Do you wish to continue?"))
        {

            return false;

        }

        foreach (allModelsThatUse(\App\Models\ElasticSearchable::class) as $model)
        {

            $endpoint = endpointFor($model);
            $index = $this->index .'-' .$endpoint;

            $this->info('Deleting ' .$index .' index...');

            $params = [
                'index' => $index,
            ];

            if (Elasticsearch::indices()->exists($params))
            {

                $return = Elasticsearch::indices()->delete($params);

                $this->info($this->done($return));

            }
            else
            {

                $this->info("Index " .$index . " does not exist.");

            }

        }


    }

}
