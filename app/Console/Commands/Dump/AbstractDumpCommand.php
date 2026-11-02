<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Closure;
use Exception;
use App\Console\Commands\BaseCommand;

abstract class AbstractDumpCommand extends BaseCommand
{
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
                    'transformer' => new $transformerClass(null, true),
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
        return Storage::disk('dumps')->path($subpath);
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
                mkdir($subdirPath, 0755);
            }
        }

        return $dumpPath;
    }

    /**
     * Throw an exception if an `.env` var is empty.
     */
    protected function validateConfig(array $vars)
    {
        foreach ($vars as $var) {
            if (empty(config($var))) {
                throw new Exception('Please specify `' . $var . '` in config');
            }
        }
    }

    /**
     * Use as the output callback for `Process::run()` to stream a process's
     * output to the console as it runs, like `passthru` does.
     */
    protected function streamOutput(): Closure
    {
        return fn (string $type, string $output) => $this->output->write($output);
    }

    /**
     * Convert each endpoint's JSONL dump to ZSTD-compressed parquet with DuckDB, in a single
     * Python process so DuckDB is only loaded once.
     */
    protected function convertToParquet(array $endpoints)
    {
        $paths = collect($endpoints)
            ->flatMap(fn ($endpoint) => [
                $this->getDumpPath('local/jsonl/' . $endpoint . '.jsonl'),
                $this->getDumpPath('local/jsonl/' . $endpoint . '.parquet'),
            ])
            ->all();

        $script = <<<'PYTHON'
            import sys, duckdb
            for src, dest in zip(sys.argv[1::2], sys.argv[2::2]):
                src_sql, dest_sql = (path.replace("'", "''") for path in (src, dest))
                duckdb.sql(f"COPY (SELECT * FROM '{src_sql}') TO '{dest_sql}' (FORMAT PARQUET, COMPRESSION 'ZSTD')")
                print(f"Generated {dest}", flush=True)
            PYTHON;

        Process::forever()->run(['python3', '-c', $script, ...$paths], $this->streamOutput())->throw();
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
