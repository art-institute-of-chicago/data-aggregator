<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

use App\Console\Helpers\Indexer;

class SearchAlias extends Command
{

    use Indexer;

    protected $signature = 'search:alias
                            {source? : The prefix of the indexes to create the alias from}
                            {alias? : The name of alias}
                            {--single : Treat the source as a single index, not a prefix for a collection of indicies}';

    protected $description = 'Create an alias for an index';


    public function handle()
    {

        $source = $this->argument('source') ?? env('ELASTICSEARCH_INDEX');
        $alias = $this->argument('alias') ?? env('ELASTICSEARCH_ALIAS');

        if ($this->option('single'))
        {

            $this->alias($source, $alias);

        } else {

            $models = app('Search')->getSearchableModels();

            foreach ($models as $model)
            {

                $endpoint = endpointFor($model);
                $index = $source . '-' . $endpoint;

                $this->alias($index, $alias);

            }

        }

    }


    public function alias($index, $alias)
    {

        $params = [
            'body' => [
                'actions' => [
                    [
                        'add' => [
                            'index' => $index,
                            'alias' => $alias
                        ]
                    ]
                ]
            ],
        ];

        $return = Elasticsearch::indices()->updateAliases($params);

        $this->info('An alias in the name of ' . $alias . ' has been created for ' . $index);

    }

}
