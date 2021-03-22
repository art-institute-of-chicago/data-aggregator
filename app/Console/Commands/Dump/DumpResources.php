<?php

namespace App\Console\Commands\Dump;

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
            $this->output->newLine(1);
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
