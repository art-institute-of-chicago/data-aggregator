<?php

namespace App\Console\Commands\Dump;

class DumpConfig extends AbstractDumpCommand
{

    protected $signature = 'dump:config';

    protected $description = 'Dump local/json/config.json';

    public function handle()
    {
        // Output config.json, which is the same for all models
        $configDocumentation = config('aic.config_documentation');

        $this->saveToJson('local/json/config.json', $configDocumentation);
    }
}
