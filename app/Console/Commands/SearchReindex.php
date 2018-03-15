<?php

namespace App\Console\Commands;

use Elasticsearch;

use App\Console\Helpers\Indexer;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class SearchReindex extends BaseCommand
{

    use Indexer;

    protected $signature = 'search:reindex
                            {dest : The prefix of the indexes to copy documents to}
                            {source? : The prefix of the indexes to copy documents from}';

    protected $description = 'Copy documents from one set of indices to another';


    public function handle()
    {

        $dest = $this->argument('dest');
        $source = $this->argument('source') ?? env('ELASTICSEARCH_INDEX');

        $models = app('Search')->getSearchableModels();

        foreach ($models as $model)
        {

            $endpoint = app('Resources')->getEndpointForModel($model);
            $index = $source . '-' . $endpoint;

            $params = [
                'wait_for_completion' => false,
                'body' => [
                    'source' => [
                        'index' => $index,
                        'size' => 100,
                    ],
                    'dest' => [
                        'index' => $dest . '-' . $endpoint,
                    ],
                ],
            ];

            $return = Elasticsearch::reindex($params);

            $this->info('Reindex from ' . $index . 'has started. You can monitor the process here: ' . $this->baseUrl() . '/_tasks/' . $return['task']);

        }

    }

}
