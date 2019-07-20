<?php

namespace App\Console\Commands\Import;

use App\Models\Collections\Artwork;

class ImportAnalytics extends AbstractImportCommand
{

    protected $signature = 'import:analytics
                            {page? : Page to begin importing from}';

    protected $description = "Import analytic pageviews for artworks";

    public function handle()
    {

        $this->api = env('ANALYTICS_DATA_SERVICE_URL');

        $this->import( 'analytics', Artwork::class, 'artworks', $this->argument('page') ?: 1 );

    }

    /**
     * Save a new model instance given an object retrieved from an external source.
     *
     * @param object  $datum
     * @param string  $model
     * @param string  $transformer
     * @param boolean $fake  Whether or not to fill missing fields w/ fake data.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function save($datum, $model, $transformer)
    {

        $transformer = new $transformer();

        // Use the id and title after they are transformed, not before!
        $id = $transformer->getId($datum);

        // TODO: Use transformed title
        $this->info("Importing #{$id}: {$datum->pageviews} | {$datum->pageviews_recent}");

        $resource = $model::find( $id );

        // Only update works that have exist in the artworks table
        if ($resource) {
            // This will be true almost always, except for lists
            if ($transformer->shouldSave( $resource, $datum ))
            {
                // Fill should always be called before sync
                // Syncing some relations requires `$instance->getKey()` to work (i.e. id is set)
                $fills = $transformer->fill( $resource, $datum );
                $syncs = $transformer->sync( $resource, $datum );

                $resource->save();
            }

            // For debugging ids and titles:
            // $this->warn("Imported #{$resource->getKey()}: {$resource->title}");
        }

        return $resource;

    }

}
