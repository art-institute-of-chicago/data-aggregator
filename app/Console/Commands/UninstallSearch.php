<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

use App\Console\Helpers\Indexer;

class UninstallSearch extends Command
{

    use Indexer;

    protected $signature = 'search:uninstall {prefix? : The prefixes of the indexes to delete} {--y|yes : Answer "yes" to all prompts confirming to delete index}';

    protected $description = 'Tear down the Search Service indexes';

    /**
     * The prefix of the indexes to delete.
     *
     * @var string
     */
    protected $prefix;


    public function __construct()
    {

        parent::__construct();
        $this->prefix = env('ELASTICSEARCH_INDEX_PREFIX', 'test_');

    }


    public function handle()
    {

        if ($this->argument('prefix'))
        {

            $this->prefix = $this->argument('prefix');

        }

        if (!$this->option('yes') && !$this->confirm("This will delete all indexes that begin with the prefix " .$this->prefix .". Do you wish to continue?"))
        {

            return false;

        }

        foreach (allModelsThatUse(\App\Models\ElasticSearchable::class) as $model)
        {

            $endpoint = endpointFor($model);
            $index = $this->prefix .$endpoint;

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
