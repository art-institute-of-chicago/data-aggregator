<?php

namespace App\Console\Commands\Import;

class ImportAssets extends ImportAssetsFull
{

    protected $signature = 'import:assets
                            {endpoint? : Endpoint on dataservice to query, e.g. `images`}
                            {--since= : How far back to scan for records}';

    protected $description = 'Import DAMS data that has been updated since the last import';

    protected $isPartial = true;

    public function handle()
    {

        $this->api = env('ASSETS_DATA_SERVICE_URL');

        $endpoint = $this->argument('endpoint');

        if ($endpoint)
        {

            $this->importEndpoint($endpoint);

        } else {

            $this->importEndpoints();

        }

    }

}
