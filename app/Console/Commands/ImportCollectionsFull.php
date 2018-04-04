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

        $this->importEndpoint('artwork-place-qualifiers');
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

            $chunked_ids = self::partition( $ids, $n );

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
     * Splits an array into a given number of (approximately) equal-sized parts.
     *
     * @link http://www.php.net/manual/en/function.array-chunk.php#75022
     *
     * @param Array $list
     * @param int $p
     *
     * @return multitype:multitype:
     */
    private static function partition(Array $list, $p) {
        $listlen = count($list);
        $partlen = floor($listlen / $p);
        $partrem = $listlen % $p;
        $partition = array();
        $mark = 0;
        for($px = 0; $px < $p; $px ++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $partition[$px] = array_slice($list, $mark, $incr);
            $mark += $incr;
        }
        return $partition;
    }

}
