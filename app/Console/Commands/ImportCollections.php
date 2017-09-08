<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportCollections extends AbstractImportCommand
{

    protected $signature = 'import:collections';

    protected $description = "Import collections data that has been updated since the last import";


    public function handle()
    {

        $this->import('artists');
        $this->import('departments');
        $this->import('categories');
        //$this->import('galleries');
        $this->import('artworks');
        $this->import('links');
        $this->import('videos');
        $this->import('texts');
        $this->import('sounds');

    }

    private function import($endpoint, $current = 1)
    {

        $class = \App\Models\CollectionsModel::classFor($endpoint);

        $json = $this->queryService($endpoint, $current);
        $pages = $json->pagination->pages->total;

        while ($current <= $pages)
        {

            foreach ($json->data as $source)
            {
                $sourceIndexedTime = new Carbon($source->indexed_at);
                $sourceIndexedTime->timezone = config('app.timezone');

                if ($this->command->last_success_at->gt($sourceIndexedTime))
                {
                    break 2;
                }

                $resource = call_user_func($class .'::findOrCreate', $source->id);

                $resource->fillFrom($source);
                $resource->attachFrom($source);
                $resource->save();

            }

            $current++;
            $json = $this->queryService($endpoint, $current);

        }

    }

    private function queryService($endpoint, $page = 1, $limit = 100)
    {
        return $this->query( env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost') . '/' . $endpoint . '?page=' . $page . '&per_page=' . $limit );
    }

}
