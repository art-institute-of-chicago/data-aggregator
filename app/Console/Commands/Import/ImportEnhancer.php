<?php

namespace App\Console\Commands\Import;

class ImportEnhancer extends ImportEnhancerFull
{
    protected $signature = 'import:enhancer
                            {endpoint? : Endpoint on dataservice to query}
                            {--since= : How far back to scan for records}';

    protected $description = 'Import enhancer data that has been updated since the last import';

    protected $isPartial = true;

    public function handle()
    {
        $this->api = config('resources.sources.dsc');

        $endpoint = $this->argument('endpoint');

        if ($endpoint) {
            $this->importEndpoint($endpoint);
        } else {
            $this->importEndpoints();
        }
    }
}
