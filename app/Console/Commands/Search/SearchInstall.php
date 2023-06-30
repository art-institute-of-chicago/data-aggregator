<?php

namespace App\Console\Commands\Search;

use Elasticsearch;

use App\Console\Helpers\Indexer;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class SearchInstall extends BaseCommand
{
    use Indexer;

    protected $signature = 'search:install
                            {prefix? : Prefix for index(es) for versioning}
                            {model? : Only create an index for this specific model}
                            {--y|yes : Answer "yes" to all prompts confirming to delete index}';

    protected $description = 'Set up the Search Service indexes with data types and fields';

    public function handle()
    {
        $prefix = $this->argument('prefix') ?? env('ELASTICSEARCH_INDEX');

        if ($this->argument('model')) {
            $this->install($this->argument('model'), $prefix);
        } else {
            $models = app('Search')->getSearchableModels();

            foreach ($models as $model) {
                $this->install($model, $prefix);
            }
        }
    }

    private function install($model, $prefix)
    {
        $index = app('Search')->getIndexForModel($model, $prefix);

        if (!$this->destroy($index, $this->option('yes'))) {
            $this->warn('Could not destroy index ' . $index . '.');
            return 0;
        }

        $params = config('elasticsearch.indexParams');

        $params['index'] = $index;
        $params['body']['mappings'] = app('Search')->getElasticsearchMapping($model);

        $return = Elasticsearch::indices()->create($params);

        $this->info($this->done($return));
    }
}
