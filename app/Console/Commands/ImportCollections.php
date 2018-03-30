<?php

namespace App\Console\Commands;

use App\Models\Collections\ArtworkType;

class ImportCollections extends AbstractImportCommandNew
{

    protected $signature = 'import:collections';

    protected $description = "Import collections data that has been updated since the last import";


    protected $isPartial = true;


    public function handle()
    {

        $this->api = env('COLLECTIONS_DATA_SERVICE_URL');

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


    private function importEndpoint($endpoint, $page = 1)
    {

        // TODO: This gets endpoints as outbound from our API
        // Endpoints in the dataservice might be different!
        $model = app('Resources')->getModelForEndpoint($endpoint);

        $this->import( $model, $endpoint, $page );

    }

}
