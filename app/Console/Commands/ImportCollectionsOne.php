<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportCollectionsOne extends AbstractImportCommand
{

    protected $signature = 'import:collections-one
                            {endpoint : Resource type to import, e.g. `artworks`}
                            {id : Identifier of the resource to import}';

    protected $description = "Import a single resource from the collections dataservice.";


    public function handle()
    {

        ini_set("memory_limit", "-1");

        $endpoint = $this->argument('endpoint');
        $id = $this->argument('id');

        $model = app('Resources')->getModelForEndpoint($endpoint);

        $json = $this->queryServiceForItem($endpoint, $id);
        $source = $json->data;

        $this->saveDatum( $source, $model );

    }

    private function queryServiceForItem($endpoint, $id)
    {

        $url = env('COLLECTIONS_DATA_SERVICE_URL') . '/' . $endpoint . '/' . $id;

        $this->info( 'Querying: ' . $url );

        $result = $this->query( $url );

        if( is_null( $result ) ) {
            throw new \Exception("Cannot contact data service: " . $url);
        }

        return $result;
    }

}
