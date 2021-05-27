<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\Storage;
use App\Library\Shell;
use Exception;

use App\Console\Commands\BaseCommand;

abstract class AbstractDumpCommand extends BaseCommand
{

    protected $shell;

    public function __construct()
    {
        parent::__construct();

        $this->shell = new Shell();
    }

    protected function getResources()
    {
        // Get all models for export, ignore category assignment
        $models = $this->getModels()->keys();

        // Instantiate a new transformer for each model class
        $resources = $models
            ->map(function ($model) {
                $transformerClass = app('Resources')->getTransformerForModel($model);
                return [
                    'model' => $model,
                    'transformer' => new $transformerClass,
                    'endpoint' => app('Resources')->getEndpointForModel($model),
                ];
            });

        if ($this->hasOption('endpoint') && ($endpoint = $this->option('endpoint'))) {
            $resources = $resources->filter(function ($resource, $key) use ($endpoint) {
                return $resource['endpoint'] === $endpoint;
            });

            if ($resources->count() < 1) {
                throw new Exception('No resources matched');
            }
        }

        return $resources;
    }

    /**
     * All of the data dumps live in `storage/dumps` per `config/filesystems.php`.
     * Use this to generate absolute paths to CSV files for `createFromPath` calls.
     *
     * @param string $subpath  ...e.g. to CSV file, relative to `storage/dumps`
     */
    protected function getDumpPath(string $subpath): string
    {
        return Storage::disk('dumps')->getDriver()->getAdapter()->getPathPrefix() . $subpath;
    }

    /**
     * If command has `--path=` option, return it. Fall back to `storage/dumps/local`.
     * Enforces correct structure in dump directory.
     */
    protected function getDumpPathOption(): string
    {
        $dumpPath = $this->hasOption('path') ? $this->option('path') : null;
        $dumpPath = $dumpPath ?? $this->getDumpPath('local');
        $dumpPath = rtrim($dumpPath, '/') . '/';

        if (!file_exists($dumpPath)) {
            throw new Exception('Directory does not exist: ' . $dumpPath);
        }

        foreach (['tables'] as $subdir) {
            $subdirPath = $dumpPath . '/' . $subdir;

            if (!file_exists($subdirPath)) {
                mkdir($subdirPath, 755);
            }
        }

        return $dumpPath;
    }

    /**
     * Throw an exception if an `.env` var is empty.
     */
    protected function validateEnv(array $vars)
    {
        foreach ($vars as $var) {
            if (empty(env($var))) {
                throw new Exception('Please specify `' . $var . '` in .env');
            }
        }
    }

    protected function toJson($input)
    {
        return json_encode($input, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    protected function saveToJson($filename, $content)
    {
        Storage::disk('dumps')->put($filename, $this->toJson($content));
    }
}
