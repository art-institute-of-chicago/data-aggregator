<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use App\Models\Collections\Asset;

class DumpResources extends AbstractDumpCommand
{
    protected $signature = 'dump:resources
                            {--endpoint= : Only export specific endpoint`}';

    protected $description = 'Dump local/json endpoints';

    public function handle()
    {
        // Not an ideal solution, but some models are really heavy
        ini_set('memory_limit', '-1');

        config(['aic.auth.restricted' => true]);

        $resources = $this->getResources();

        $resources->each(function ($resource) {
            $this->info('Dumping ' . $resource['endpoint'] . ' as JSON files');

            $resource['model']::addRestrictContentScopes(true);

            $relativeDumpPath = 'local/json/' . $resource['endpoint'];
            $absoluteDumpPath = $this->getDumpPath($relativeDumpPath);

            if (!file_exists($absoluteDumpPath)) {
                mkdir($absoluteDumpPath, 0755, true);
                chmod($absoluteDumpPath, 0755);
            }

            $bar = $this->output->createProgressBar($resource['model']::count());

            foreach ($resource['model']::cursor() as $item) {
                $filename = $relativeDumpPath . '/' . $this->getItemId($item) . '.json';
                $content = $resource['transformer']->transform($item);

                $this->saveToJson($filename, $content);

                $bar->advance();
            }

            $bar->finish();
            $this->output->newLine(2);
        });

        $resources->each(function ($resource) {
            $this->info('Dumping ' . $resource['endpoint'] . ' in single JSONL file');

            $resource['model']::addRestrictContentScopes(true);

            $relativeDumpPath = 'local/jsonl';
            $absoluteDumpPath = $this->getDumpPath($relativeDumpPath);

            if (!file_exists($absoluteDumpPath)) {
                mkdir($absoluteDumpPath, 0755, true);
                chmod($absoluteDumpPath, 0755);
            }

            $filePath = $relativeDumpPath . "/{$resource['endpoint']}.jsonl";
            Storage::disk('dumps')->delete($filePath);

            $bar = $this->output->createProgressBar($resource['model']::count());

            foreach ($resource['model']::cursor() as $item) {
                $content = $resource['transformer']->transform($item);
                $record = $content['data'] ?? $content;

                if (isset($content['config']['iiif_url'])) {
                    $record['iiif_url'] = $content['config']['iiif_url'];
                }

                Storage::disk('dumps')->append(
                    $filePath,
                    json_encode($record, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
                );

                $bar->advance();
            }

            $bar->finish();
            $this->output->newLine(2);

            $sql = "COPY (SELECT * FROM 'storage/dumps/local/jsonl/{$resource['endpoint']}.jsonl') TO 'storage/dumps/local/jsonl/{$resource['endpoint']}.parquet' (FORMAT PARQUET, COMPRESSION 'ZSTD');";

            $result = Process::run([
                'python3',
                '-c',
                "import duckdb; duckdb.sql(\"{$sql}\")"
            ]);

            if ($result->successful()) {
                $this->info("Parquet for {$resource['endpoint']} generated successfully!");
            } else {
                $this->error("DuckDB Error: " . $result->errorOutput());
            }
        });
    }

    private function getItemId($item)
    {
        if ($item instanceof Asset) {
            return Asset::getHashedId($item->getKey());
        }

        return $item->getKey();
    }
}
