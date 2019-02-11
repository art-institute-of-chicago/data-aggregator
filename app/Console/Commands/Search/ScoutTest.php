<?php

namespace App\Console\Commands\Search;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ScoutTest extends BaseCommand
{

    protected $signature = 'scout:test';

    protected $description = 'Attempt to import a single batch of all models';

    public function handle()
    {
        $models = app('Search')->getSearchableModels();

        foreach ($models as $model)
        {
            $this->testSearchable($model);
        }
    }


    public function testSearchable($model)
    {
        $this->output->write('Testing ' . $model . '... ', false);

        $model::take(config('scout.chunk.searchable'))->get()->searchable();

        $this->info('Success!');
    }

}
