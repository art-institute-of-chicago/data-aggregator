<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

use App\Console\Helpers\Indexer;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AliasSearch extends Command
{

    use Indexer;

    protected $signature = 'search:alias
                            {source : The name of the index to create an alias for}
                            {alias : The name of alias}';

    protected $description = 'Create an alias for an index';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        $source = $this->argument('source');
        $alias = $this->argument('alias');

        $params = [
            'body' => [
                'actions' => [
                    [
                        'add' => [
                            'index' => $source,
                            'alias' => $alias
                        ]
                    ]
                ]
            ],
        ];

        $return = Elasticsearch::indices()->updateAliases($params);

        $this->info('An alias in the name of ' .$alias .' has been created for ' .$source);

    }

}
