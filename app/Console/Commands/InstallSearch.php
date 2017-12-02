<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;
use Artisan;

use App\Console\Helpers\Indexer;

class InstallSearch extends Command
{

    use Indexer;

    protected $signature = 'search:install {index? : The name of the index to create. Will be created as an alias to a set of indexes with the same prefixes} {--y|yes : Answer "yes" to all prompts confirming to delete index}';

    protected $description = 'Set up the Search Service indexes with data types and fields';

    /**
     * The prefix of the indexes to create.
     *
     * @var string
     */
    protected $index;


    public function __construct()
    {

        parent::__construct();
        $this->index = env('ELASTICSEARCH_INDEX', 'test');

    }


    public function handle()
    {

        if ($this->argument('index'))
        {

            $this->index = $this->argument('index');

        }

        foreach (allModelsThatUse(\App\Models\ElasticSearchable::class) as $model)
        {

            $endpoint = endpointFor($model);
            $index = $this->index .'-' .$endpoint;

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

            Artisan::call('search:alias', ['source' => $index, 'alias' => $this->index]);

        }

    }

}
