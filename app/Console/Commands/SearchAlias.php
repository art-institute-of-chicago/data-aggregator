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


    /**
     * The prefix of the indexes to create the alias from
     *
     * @var string
     */
    protected $source;


    /**
     * The name of the alias to create
     *
     * @var string
     */
    protected $alias;


    public function __construct()
    {

        parent::__construct();
        $this->source = env('ELASTICSEARCH_INDEX');
        $this->alias = env('ELASTICSEARCH_ALIAS');

    }


    public function handle()
    {

        if ($this->argument('alias'))
        {

            $this->alias = $this->argument('alias');

        }

        if ($this->argument('source'))
        {

            $this->source = $this->argument('source');

        }

        if ($this->option('single'))
        {

            $this->alias($this->source, $this->alias);

        }
        else
        {

            foreach (allModelsThatUse(\App\Models\ElasticSearchable::class) as $model)
            {

                $endpoint = endpointFor($model);
                $index = $this->source .'-' .$endpoint;

                $this->alias($index, $this->alias);
            }

        }

    }


    public function alias($index)
    {

        $params = [
            'body' => [
                'actions' => [
                    [
                        'add' => [
                            'index' => $index,
                            'alias' => $this->alias
                        ]
                    ]
                ]
            ],
        ];

        $return = Elasticsearch::indices()->updateAliases($params);

        $this->info('An alias in the name of ' .$this->alias .' has been created for ' .$index);

    }

}
