<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportCollections extends AbstractImportCommand
{

    protected $signature = 'import:collections';

    protected $description = "Import collections data that has been updated since the last import";


    public function handle()
    {

        $this->import('agent-types');
        $this->import('agent-places');
        $this->import('agents');
        $this->import('departments');
        $this->import('object-types');
        $this->import('categories');
        $this->import('places');
        $this->import('artwork-catalogues');
        $this->import('catalogues');
        $this->import('artworks');
        $this->import('links');
        $this->import('videos');
        $this->import('texts');
        $this->import('sounds');
        $this->import('images');
        $this->import('exhibition-agents');
        $this->import('exhibitions');

    }

    private function import($endpoint, $current = 1)
    {

        $model = app('Resources')->getModelForEndpoint($endpoint);

        $json = $this->queryService($endpoint, $current);
        $pages = $json->pagination->pages->total;

        $this->info( 'Found ' . $pages . ' page(s) for model ' . $model );

        while ($current <= $pages)
        {

            $this->warn( 'Importing ' . $current . ' of ' . $pages . ' for model ' . $model );

            foreach ($json->data as $source)
            {
                $sourceIndexedTime = new Carbon($source->indexed_at);
                $sourceIndexedTime->timezone = config('app.timezone');

                if ($this->command->last_success_at->gt($sourceIndexedTime))
                {
                    break 2;
                }

                $this->saveDatum( $source, $model );

            }

            $current++;
            $json = $this->queryService($endpoint, $current);

        }

    }

    private function queryService($endpoint, $page = 1, $limit = 100)
    {

        $url = env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost') . '/' . $endpoint . '?page=' . $page . '&per_page=' . $limit;

        $this->info( 'Querying: ' . $url );

        $result = $this->query( $url );

        if( is_null( $result ) ) {
            throw new \Exception("Cannot contact data service: " . $url);
        }

        return $result;

    }

}
