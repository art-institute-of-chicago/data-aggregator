<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Exception;
use Throwable;

class DumpExport extends AbstractDumpCommand
{

    protected $signature = 'dump:export
                            {--path= : Directory where to save dump, with `json` subdir }';

    protected $description = 'Create JSON dumps of all public endpoints';

    public function handle()
    {
        $dumpPath = $this->getDumpPath('local/json');
        $this->shell->passthru('rm -rf %s/*', $dumpPath);

        // Get all models for export
        $models = $this->getModels();

        foreach ($models as $model => $category) {
            // Remove any old JSONs in this dump
            $dumpPath = $this->getDumpPath('local/json/' .app('Resources')->getEndpointForModel($model));
            if (!file_exists($dumpPath)) {
                mkdir($dumpPath, 1777, true);
            }

            // Create transformer used for generating JSON output
            $transformer = app('Resources')->getTransformerForModel($model);
            $transformer = new $transformer;

            $model::addRestrictContentScopes();

            // Give feedback to the user
            $this->info(app('Resources')->getEndpointForModel($model));
            $bar = $this->output->createProgressBar($model::count());

            // Loop through each record and dump its contents into a file
            $model::chunk(100, function ($items) use ($transformer, $model, $bar) {
                foreach ($items as $key => $item) {
                    $filename = 'local/json/' .app('Resources')->getEndpointForModel($model) .'/' .$item->{$item->getKeyName()}. '.json';
                    Storage::disk('dumps')->put($filename, json_encode(['data' => $transformer->transform($item),
                                                                        'info' => $transformer->getInfoFields(),
                                                                        'config' => config('aic.config_documentation')], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
                }
                $bar->advance($items->count());
            });
            $bar->finish();
            $this->output->newLine(1);
        }
    }
}
