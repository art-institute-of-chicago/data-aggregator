<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\Storage;
use App\Models\Collections\Asset;

class DumpResources extends AbstractDumpCommand
{
    protected $signature = 'dump:resources
                            {--endpoint= : Only export specific endpoint`}
                            {--skip-parquet : Don\'t convert JSONL to parquet, e.g. when `dump:export` does it}';

    protected $description = 'Dump local/json endpoints';

    public function handle()
    {
        // Not an ideal solution, but some models are really heavy
        ini_set('memory_limit', '-1');

        config(['aic.auth.restricted' => true]);

        $resources = $this->getResources();

        $configDocumentation = config('aic.config_documentation');

        $resources->each(function ($resource) use ($configDocumentation) {
            $this->info('Dumping ' . $resource['endpoint']);

            $resource['model']::addRestrictContentScopes(true);

            $relativeDumpPathJson = 'local/json/' . $resource['endpoint'];
            $absoluteDumpPathJson = $this->getDumpPath($relativeDumpPathJson);

            if (!file_exists($absoluteDumpPathJson)) {
                mkdir($absoluteDumpPathJson, 0755, true);
                chmod($absoluteDumpPathJson, 0755);
            }

            $relativeDumpPathJsonl = 'local/jsonl';
            $absoluteDumpPathJsonl = $this->getDumpPath($relativeDumpPathJsonl);

            if (!file_exists($absoluteDumpPathJsonl)) {
                mkdir($absoluteDumpPathJsonl, 0755, true);
                chmod($absoluteDumpPathJsonl, 0755);
            }

            $filePathJsonl = $relativeDumpPathJsonl . "/{$resource['endpoint']}.jsonl";
            Storage::disk('dumps')->delete($filePathJsonl);
            $handleJsonl = fopen($this->getDumpPath($filePathJsonl), 'w');

            // These are the same for every record, so only look them up once
            $licenseText = $resource['transformer']->getLicenseText();
            $licenseLinks = $resource['transformer']->getLicenseLinks();

            $bar = $this->output->createProgressBar($resource['model']::count());

            // Eager-load the relations the transformer uses one chunk at a time, instead of one query per record
            $items = $resource['model']::with((new $resource['model']())->getDumpWith())->lazyById(1000);

            foreach ($items as $item) {
                $content = $resource['transformer']->transform($item);

                // JSON
                file_put_contents(
                    $absoluteDumpPathJson . '/' . $this->getItemId($item) . '.json',
                    $this->toJson($content)
                );

                // JSONL
                $record = $content['data'] ?? $content;

                if (isset($configDocumentation['iiif_url'])) {
                    $record['iiif_url'] = $configDocumentation['iiif_url'];
                }
                if (isset($record['timestamp'])) {
                    unset($record['timestamp']);
                }
                $record['license_text'] = $licenseText;
                $record['license_links'] = $licenseLinks;

                fwrite($handleJsonl, json_encode($record, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");

                $bar->advance();
            }

            $bar->finish();
            fclose($handleJsonl);
            $this->output->newLine(2);
        });

        if (!$this->option('skip-parquet')) {
            $this->convertToParquet($resources->pluck('endpoint')->all());
        }
    }

    private function getItemId($item)
    {
        if ($item instanceof Asset) {
            return Asset::getHashedId($item->getKey());
        }

        return $item->getKey();
    }
}
