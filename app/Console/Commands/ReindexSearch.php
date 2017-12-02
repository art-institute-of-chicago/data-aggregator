<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

use App\Console\Helpers\Indexer;

class ReindexSearch extends Command
{

    use Indexer;

    protected $signature = 'search:reindex
                            {dest : The name of the index to copy documents to}
                            {source? : The prefix of the indexes to create the alias from}';

    protected $description = 'Copy documents from one set of indices to another';


    public function handle()
    {

        $source = env('ELASTICSEARCH_INDEX', 'test-latest-prefix');
        $dest = $this->argument('dest');

        if ($this->argument('source'))
        {

            $source = $this->argument('source');

        }

        foreach (allModelsThatUse(\App\Models\ElasticSearchable::class) as $model)
        {

            $endpoint = endpointFor($model);
            $index = $source .'-' .$endpoint;

            $params = [
                'wait_for_completion' => false,
                'body' => [
                    'source' => [
                        'index' => $index,
                        'size' => 100,
                    ],
                    'dest' => [
                        'index' => $dest .'-' .$endpoint,
                    ],
                ],
            ];

            $return = Elasticsearch::reindex($params);

            $this->info('Reindex from ' .$index .'has started. You can monitor the process here: ' .$this->baseUrl() .'/_tasks/' .$return['task']);

        }

    }

}
