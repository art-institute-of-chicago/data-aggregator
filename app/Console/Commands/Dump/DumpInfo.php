<?php

namespace App\Console\Commands\Dump;

class DumpInfo extends AbstractDumpCommand
{
    protected $signature = 'dump:info';

    protected $description = 'Dump local/json/info.json';

    public function handle()
    {
        $resources = $this->getResources();

        // Output info.json, which combines the info blocks for all models
        $infoBlocks = $resources
            ->map(function ($resource) {
                return [
                    $resource['endpoint'] => $resource['transformer']->getInfoFields(),
                ];
            })
            ->collapse()
            ->all();

        $this->saveToJson('local/json/info.json', $infoBlocks);
    }
}
