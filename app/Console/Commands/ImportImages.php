<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportImages extends AbstractImportCommand
{

    protected $signature = 'import:images';

    protected $description = "Import all image data from data-service-images";


    public function handle()
    {

        $this->import('images');

    }

    private function import($endpoint, $current = 1)
    {

        $model = app('Resources')->getModelForEndpoint($endpoint);

        $json = $this->queryService($endpoint, $current);
        $pages = $json->pagination->total_pages;

        $this->info( 'Found ' . $pages . ' page(s) for model ' . $model );

        while ($current <= $pages)
        {

            $this->info( 'Importing ' . $current . ' of ' . $pages . ' for model ' . $model );

            foreach ($json->data as $source)
            {

                // TODO: Move this into an inbound transformer?
                $this->saveDatum( $source, $model );

            }

            $current++;
            $json = $this->queryService($endpoint, $current);

        }

    }

    private function queryService($endpoint, $page = 1, $limit = 100)
    {
        $url = env('IMAGES_DATA_SERVICE_URL') . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit;

        $this->info( $url );

        $result = $this->query( $url );

        if( is_null( $result ) ) {
            throw new \Exception("Cannot contact data service: " . $url);
        }

        return $result;
    }


    /**
     * Save a new model instance given an object retrieved from an external source.
     *
     * @param object  $datum
     * @param string  $model
     * @param boolean $fake  Whether or not to fill missing fields w/ fake data.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function saveDatum( $datum, $model )
    {

        $this->info("Importing #{$datum->id}: {$datum->title}");

        // TODO: When we make inbound transformers, provide a toggle between find() & findOrNew()
        $resource = $model::find( $datum->id );

        // For this one, we should ignore entities that don't exist here
        if( !$resource )
        {
            return;
        }

        // TODO: Move this to an inbound transformer
        $metadata = $image->metadata ?? (object) [];

        $metadata->lqip = $datum->lqip;
        $metadata->color = $datum->color;
        $metadata->width = $datum->width;
        $metadata->height = $datum->height;

        $resource->metadata = $metadata;

        $resource->save();

        return $resource;

    }

}
