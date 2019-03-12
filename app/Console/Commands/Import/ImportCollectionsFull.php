<?php

namespace App\Console\Commands\Import;

use App\Models\Collections\AgentRole;
use App\Models\Collections\ArtworkType;

class ImportCollectionsFull extends AbstractImportCommand
{

    protected $signature = 'import:collections-full
                            {endpoint? : Endpoint on dataservice to query, e.g. `object-types`}
                            {page? : Page to begin importing from}
                            {--test : Only import one page from each endpoint}';

    protected $description = "Import all collections data. If no options are passed all Collections data will be imported.";


    public function handle()
    {

        if ($this->option('test')) {
            $this->isTest = true;
        }

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

        // Lists:
        $this->importEndpoint('artwork-agent-roles');
        // $this->importEndpoint('artwork-date-qualifiers');
        $this->importEndpoint('artwork-place-qualifiers');
        $this->importEndpoint('object-types');
        $this->importEndpoint('agent-types');
        $this->importEndpoint('catalogues');
        $this->importEndpoint('categories');
        $this->importEndpoint('terms');

        $this->importEndpoint('places');
        $this->importEndpoint('galleries');

        // $this->importEndpoint('videos');
        // $this->importEndpoint('texts');
        // $this->importEndpoint('sounds');
        // $this->importEndpoint('images');

        $this->importEndpoint('agents');
        $this->importEndpoint('exhibitions');
        $this->importEndpoint('artworks');

    }

    protected function importEndpoint($endpoint, $page = 1)
    {

        $model = $this->getModelForEndpoint($endpoint);

        $this->import( 'Collections', $model, $endpoint, $page );

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

    /**
     * This method will take an array of ids and return an array of URLs to the CDS API,
     * which utilize the `?ids=a,b,c` syntax. It'll iterate on chunking the ids until the
     * URLs it generates all satisfy a reasonable length criteria (600 chars).
     *
     * @param array $ids
     * @param string $endpoint
     *
     * @return array
     */
    private function getUrls( array $ids, $endpoint )
    {

        $n = 0;

        do {

            $n++;

            $chunked_ids = partition( $ids, $n );

            $urls = array_map( function( $ids ) use ($endpoint) {

                return env('COLLECTIONS_DATA_SERVICE_URL')
                    . '/' . $endpoint
                    . '?limit=' . count( $ids )
                    . '&ids=' . implode(',', $ids);

            }, $chunked_ids);

            // Don't generate a URL longer than 600 characters, including prefix
            $max_url_length = max(array_map('strlen', $urls));

        } while( $max_url_length > 600 );

        return $urls;

    }

    /**
     * Temporarily overriding this to have control over the `$limit` default here.
     */
    protected function query( $endpoint, $page = 1, $limit = 500 )
    {
        // Avoid retrieving too many assets at once
        $limit = in_array($endpoint, ['videos', 'texts', 'sounds', 'images']) ? 10 : 100;

        return parent::query( $endpoint, $page, $limit );
    }

}
