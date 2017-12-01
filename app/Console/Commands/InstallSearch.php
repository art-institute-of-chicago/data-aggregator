<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

use App\Console\Helpers\Indexer;

class InstallSearch extends Command
{

    use Indexer;

    protected $signature = 'search:install {prefix? : The prefixes of the indexes to create} {--y|yes : Answer "yes" to all prompts confirming to delete index}';

    protected $description = 'Set up the Search Service indexes with data types and fields';

    /**
     * The prefix of the indexes to create.
     *
     * @var string
     */
    protected $prefix;


    public function __construct()
    {

        parent::__construct();
        $this->prefix = env('ELASTICSEARCH_INDEX_PREFIX', 'data_aggregator_test_');

    }


    public function handle()
    {

        if ($this->argument('prefix'))
        {

            $this->prefix = $this->argument('prefix');

        }

        foreach (allModelsThatUse(\App\Models\ElasticSearchable::class) as $model)
        {

            $endpoint = endpointFor($model);
            $index = $this->prefix .$endpoint;

            if (!$this->destroy($index, $this->option('yes')))
            {

                $this->warn('Could not destroy index ' .$index .'. Exiting.');

                return 0;

            }

            $params = config('elasticsearch.indexParams');
            $params['index'] = $index;
            $params['body']['mappings'] = $model::instance()->elasticsearchMapping();

            $return = Elasticsearch::indices()->create($params);

            $this->info($this->done($return));

        }

    }

}
