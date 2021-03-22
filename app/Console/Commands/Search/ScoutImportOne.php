<?php

namespace App\Console\Commands\Search;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ScoutImportOne extends BaseCommand
{

    protected $signature = 'scout:import-one
                            {model}
                            {id}';

    protected $description = 'Import one instance of a model into the search index';

    public function handle()
    {
        $id = $this->argument('id');
        $class = $this->argument('model');

        $model = new $class();

        if ($model instanceof \App\Models\Collections\Asset) {
            $model::query()
                ->where('lake_guid', $id)
                ->orWhere('netx_uuid', $id)
                ->first()
                ->searchable();
        } else {
            $model::find($id)->searchable();
        }

        $this->info("Imported #${id} of model ${class}");
    }
}
