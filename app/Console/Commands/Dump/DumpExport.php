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
                            {endpoint? : Only export specific endpoint`}
                            {--reset : Remove everything in existing dump}
                            {--path= : Directory where to save dump, with `json` subdir }';

    protected $description = 'Create JSON dumps of all public endpoints';

    public function handle()
    {
        $dumpPath = $this->getDumpPath('local/json');

        // Remove everything in this dump
        if ($this->option('reset')) {
            $this->warn('Removing everything in existing dump directory...');
            $this->shell->passthru('rm -rf %s/*', $dumpPath);
        }

        $this->saveConfigDocs();

        // Get all models for export, ignore category assignment
        $models = $this->getModels()->keys();

        // Instantiate a new transformer for each model class
        $resources = $models
            ->map(function($model) {
                $transformerClass = app('Resources')->getTransformerForModel($model);
                return [
                    'model' => $model,
                    'transformer' => new $transformerClass,
                    'endpoint' => app('Resources')->getEndpointForModel($model),
                ];
            });

        if ($endpoint = $this->argument('endpoint')) {
            $resources = $resources->filter(function($resource, $key) use ($endpoint) {
                return $resource['endpoint'] === $endpoint;
            });

            if ($resources->count() < 1) {
                $this->warn('No resources matched');
                return;
            }
        }

        $this->saveInfoBlocks($resources);

        $resources->each(function($resource) {
            $resource['model']::addRestrictContentScopes();

            $relativeDumpPath = 'local/json/' . $resource['endpoint'];
            $absoluteDumpPath = $this->getDumpPath($relativeDumpPath);

            if (!file_exists($absoluteDumpPath)) {
                mkdir($absoluteDumpPath, 0755, true);
                chmod($absoluteDumpPath, 0755);
            }

            $bar = $this->output->createProgressBar($resource['model']::count());

            foreach ($resource['model']::cursor() as $item) {
                $filename = $relativeDumpPath . '/' . $item->getKey() . '.json';
                $content = $resource['transformer']->transform($item);

                $this->saveToJson($filename, $content);

                $bar->advance();
            }

            $bar->finish();
            $this->output->newLine(1);

        });

    }

    private function saveConfigDocs()
    {
        // Output config.json, which is the same for all models
        $configDocumentation = config('aic.config_documentation');

        $this->saveToJson('local/json/config.json', $configDocumentation);
    }

    private function saveInfoBlocks($resources)
    {
        // Output info.json, which combines the info blocks for all models
        $infoBlocks = $resources
            ->map(function($resource) {
                return [
                    $resource['endpoint'] => $resource['transformer']->getInfoFields(),
                ];
            })
            ->collapse()
            ->all();

        $this->saveToJson('local/json/info.json', $infoBlocks);
    }

    private function toJson($input)
    {
        return json_encode($input, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    private function saveToJson($filename, $content)
    {
        Storage::disk('dumps')->put($filename, $this->toJson($content));
    }
}
