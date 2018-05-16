<?php

namespace App\Console\Commands;

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

    /**
     * Temporarily overriding this to have control over the `$limit` default here.
     *
     * @TODO Implement eager loading for pivot fields in the dataservice.
     */
    protected function query( $endpoint, $page = 1, $limit = 500 )
    {
        return parent::query( $endpoint, $page, $limit );
    }

}
