<?php

namespace App\Console\Commands\Import;

class ImportCollections extends ImportCollectionsFull
{

    protected $signature = 'import:collections
                            {endpoint? : Endpoint on dataservice to query, e.g. `object-types`}';

    protected $description = "Import collections data that has been updated since the last import";


    protected $isPartial = true;


    public function handle()
    {

        $this->api = env('COLLECTIONS_DATA_SERVICE_URL');

        $endpoint = $this->argument('endpoint');

        if ($endpoint)
        {

            $this->importEndpoint($endpoint);

        } else {

            $this->importEndpoints();

        }

    }

}
