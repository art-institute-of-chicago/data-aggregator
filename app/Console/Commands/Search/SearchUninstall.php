<?php

namespace App\Console\Commands\Search;

use Elasticsearch;

use App\Console\Helpers\Indexer;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class SearchUninstall extends BaseCommand
{

    use Indexer;

    protected $signature = 'search:uninstall
                            {index? : The group of indexes to delete}
                            {--y|yes : Answer "yes" to all prompts confirming to delete index}';

    protected $description = 'Tear down the Search Service indexes';

    public function handle()
    {
        $prefix = $this->argument('index') ?? env('ELASTICSEARCH_INDEX');

        if (!$this->option('yes') && !$this->confirm('This will delete all indexes with `' . $prefix . '` prefix. Are you sure?'))
        {

            return false;

        }

        $models = app('Search')->getSearchableModels();

        foreach ($models as $model)
        {

            $index = app('Search')->getIndexForModel($model, $prefix);

            $this->info('Deleting ' . $index . ' index...');

            $params = [
                'index' => $index,
            ];

            if (Elasticsearch::indices()->exists($params))
            {

                $return = Elasticsearch::indices()->delete($params);

                $this->info($this->done($return));

            } else {

                $this->info('Index ' . $index . ' does not exist.');

            }

        }
    }

}
