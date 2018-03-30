<?php

namespace App\Console\Commands;

use App\Models\Collections\AgentRole;
use App\Models\Collections\ArtworkType;

class ImportCollectionsFull extends AbstractImportCommandNew
{

    protected $signature = 'import:collections-full
                            {endpoint? : Endpoint on dataservice to query, e.g. `object-types`}
                            {page? : Page to begin importing from}';

    protected $description = "Import all collections data. If no options are passed all Collections data will be imported.";


    public function handle()
    {

        ini_set("memory_limit", "-1");

        $this->api = env('COLLECTIONS_DATA_SERVICE_URL');

        $endpoint = $this->argument('endpoint');

        if ($endpoint) {

            $page = $this->argument('page') ?: 1;

            $this->importEndpoint($endpoint, $page);

        } else {

            $this->importEndpoints();

        }

    }

    protected function importEndpoints()
    {

        $this->importEndpoint('artwork-agent-roles');
        $this->importEndpoint('object-types');
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

    protected function importEndpoint($endpoint, $page = 1)
    {

        $model = $this->getModelForEndpoint($endpoint);

        $this->import( $model, $endpoint, $page );

    }

    protected function getModelForEndpoint($endpoint)
    {

        // TODO: Outbound endpoints don't always equal inbound endpoints
        // Consider specifying them in inbound transformers? Or config file?
        switch( $endpoint )
        {
            case 'artwork-agent-roles':
                $model = AgentRole::class;
            break;
            case 'object-types':
                $model = ArtworkType::class;
            break;
            default:
                // TODO: This gets endpoints as outbound from our API
                // Endpoints in the dataservice might be different!
                $model = app('Resources')->getModelForEndpoint($endpoint);
            break;
        }

        return $model;
    }

}
