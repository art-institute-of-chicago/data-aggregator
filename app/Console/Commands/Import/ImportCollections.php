<?php

namespace App\Console\Commands\Import;

class ImportCollections extends ImportCollectionsFull
{
    protected $signature = 'import:collections
                            {endpoint? : Endpoint on dataservice to query, e.g. `object-types`}
                            {--since= : How far back to scan for records}';

    protected $description = 'Import collections data that has been updated since the last import';

    protected $isPartial = true;

    public function handle()
    {
        $this->api = config('resources.sources.collections');

        $endpoint = $this->argument('endpoint');

        if ($endpoint) {
            $this->importEndpoint($endpoint);
        } else {
            $this->importEndpoints();
        }
    }
}
