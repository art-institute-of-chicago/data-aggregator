<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;
use Artisan;

use App\Console\Helpers\Indexer;

class SearchInstall extends Command
{

    use Indexer;

    protected $signature = 'search:install
                            {index? : The name of the index to create. Will be created as an alias to a set of indexes with the same prefixes}
                            {--y|yes : Answer "yes" to all prompts confirming to delete index}';

    protected $description = 'Set up the Search Service indexes with data types and fields';


    public function handle()
    {

        $prefix = $this->argument('index') ?? env('ELASTICSEARCH_INDEX');

        $models = app('Search')->getSearchableModels();

        foreach ($models as $model)
        {

            $endpoint = endpointFor($model);
            $index = $prefix . '-' . $endpoint;

            if (!$this->destroy($index, $this->option('yes')))
            {

                $this->warn('Could not destroy index ' . $index . '. Exiting.');

                return 0;

            }

            $params = config('elasticsearch.indexParams');
            $params['index'] = $index;
            $params['body']['mappings'] = $model::instance()->elasticsearchMapping();

            $return = Elasticsearch::indices()->create($params);

            $this->info($this->done($return));

            Artisan::call('search:alias', ['source' => $index, 'alias' => $prefix, '--single' => true]);

        }

    }

}
