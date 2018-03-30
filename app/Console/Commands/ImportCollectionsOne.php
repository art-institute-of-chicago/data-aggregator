<?php

namespace App\Console\Commands;

class ImportCollectionsOne extends AbstractImportCommandNew
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

        $json = $this->fetchItem( $endpoint, $id );

        $source = $json->data;

        $this->save( $source, $model );

    }

    private function fetchItem( $endpoint, $id )
    {

        $url = env('COLLECTIONS_DATA_SERVICE_URL') . '/' . $endpoint . '/' . $id;

        $this->info( 'Fetching: ' . $url );

        return $this->fetch( $url, true );
    }

}
