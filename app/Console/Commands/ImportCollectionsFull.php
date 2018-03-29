<?php

namespace App\Console\Commands;

use App\Models\Collections\ArtworkType;

class ImportCollectionsFull extends AbstractImportCommandNew
{

    protected $signature = 'import:collections-full
                            {endpoint? : Last portion of the URL indicating resource to import, e.g. "artists"}
                            {page? : Page to begin importing from}';

    protected $description = "Import all collections data. If no options are passed all Collections data will be imported.";


    public function handle()
    {

        ini_set("memory_limit", "-1");

        $this->api = env('COLLECTIONS_DATA_SERVICE_URL');

        if ($this->argument('endpoint'))
        {

            $page = $this->argument('page') ?: 1;

            $this->importEndpoint($this->argument('endpoint'), $page);

        }
        else
        {

            $this->import( ArtworkType::class, 'object-types');

            $this->importEndpoint('agent-types');
            $this->importEndpoint('agent-places');
            $this->importEndpoint('agents');
            $this->importEndpoint('categories');
            $this->importEndpoint('places');
            $this->importEndpoint('galleries');
            $this->importEndpoint('artwork-catalogues');
            $this->importEndpoint('catalogues');
            $this->importEndpoint('artworks');
            $this->importEndpoint('links');
            $this->importEndpoint('videos');
            $this->importEndpoint('texts');
            $this->importEndpoint('sounds');
            $this->importEndpoint('images');
            $this->importEndpoint('exhibition-agents');
            $this->importEndpoint('exhibitions');
            $this->importEndpoint('term-types');
            $this->importEndpoint('terms');

        }

    }


    private function importEndpoint($endpoint, $page = 1)
    {

        // TODO: This gets endpoints as outbound from our API
        // Endpoints in the dataservice might be different!
        $model = app('Resources')->getModelForEndpoint($endpoint);

        $this->import( $model, $endpoint, $page );

    }

}
