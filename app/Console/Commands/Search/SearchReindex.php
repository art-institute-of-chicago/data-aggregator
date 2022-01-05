<?php

namespace App\Console\Commands\Search;

use Elasticsearch;

use App\Console\Helpers\Indexer;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class SearchReindex extends BaseCommand
{

    use Indexer;

    protected $signature = 'search:reindex
                            {dest : The prefix of the indexes to copy documents to}
                            {source? : The prefix of the indexes to copy documents from}
                            {model? : Classname of model to reindex}';

    protected $description = 'Copy documents from one set of indices to another';

    protected $dest;

    protected $source;

    public function handle()
    {
        $this->dest = $this->argument('dest');
        $this->source = $this->argument('source') ?? env('ELASTICSEARCH_INDEX');

        if ($this->argument('model')) {
            $this->reindex($this->argument('model'));
        } else {
            $models = app('Search')->getSearchableModels();

            foreach ($models as $model) {
                $this->reindex($model);
            }
        }
    }

    public function reindex($model)
    {
        $index = app('Search')->getIndexForModel($model, $this->source);

        $params = [
            'wait_for_completion' => true,
            'body' => [
                'source' => [
                    'index' => $index,
                    'size' => 100,
                ],
                'dest' => [
                    'index' => app('Search')->getIndexForModel($model, $this->dest),
                    'type' => app('Search')->getTypeForModel($model),
                ],
            ],
        ];

        $this->warn('Reindex from ' . $index . ' is starting...');

        $return = Elasticsearch::reindex($params);

        $this->info('Reindex from ' . $index . ' has finished.');
    }
}
