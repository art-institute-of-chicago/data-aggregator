<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportCollections extends AbstractImportCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:collections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Import collections data that has been updated since the last import";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
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

                if ($this->command->last_ran_at->lte($sourceIndexedTime))
                {

                    $resource = call_user_func($class .'::findOrCreate', $source->id);

                    $resource->fillFrom($source);
                    $resource->attachFrom($source);
                    $resource->save();

                }
                else
                {

                    break 2;

                }

            }

            $current++;
            $json = $this->queryService($endpoint, $current);

        }

    }

    private function queryService($type = 'artworks', $page = 1)
    {
        return $this->query( env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost') .'/' .$type .'?page=' .$page .'&per_page=100' );
    }

}
