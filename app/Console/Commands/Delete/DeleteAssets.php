<?php

namespace App\Console\Commands\Delete;

use Carbon\Carbon;
use App\Console\Commands\Import\AbstractImportCommand;

class DeleteAssets extends AbstractImportCommand
{

    protected $signature = 'delete:assets
                            {--since= : How far back to scan for records}';

    protected $description = 'Delete records that have been removed from the DAMS';

    /**
     * Which models to cross-reference against tombstones.
     *
     * @var array
     */
    protected $models = [
        \App\Models\Collections\Image::class,
        \App\Models\Collections\Sound::class,
        \App\Models\Collections\Text::class,
        \App\Models\Collections\Video::class,
    ];

    /**
     * LAKE creates "tombstone" records with `deleted:true` for any record that has been
     * unpublished. These records are minimal, containing only the timestamp, deleted
     * status, and the LAKE UUID. This function will loop through all tombstone records
     * ordered by timestamp descending until it reaches one that's older than its last
     * successful run. It'll take the UUID of each record, loop through the `$models`
     * until it finds a match, and delete that record.
     */
    public function handle()
    {
        $this->api = env('ASSETS_DATA_SERVICE_URL');

        $current = 1;

        $json = $this->query('deletes', $current);
        $pages = $json->pagination->total_pages;

        $this->warn( 'Found ' . $pages . ' pages' );

        while( $current <= $pages )
        {
            $this->warn( 'Deleting ' . $current . ' of ' . $pages);

            // Assumes the dataservice wraps its results in a `data` field
            foreach( $json->data as $datum )
            {
                // Break if we're past the last time we checked
                $sourceTime = new Carbon( $datum->indexed_at );
                $sourceTime->timezone = config('app.timezone');

                if( $this->since->gt( $sourceTime ) )
                {
                    break 2;
                }

                // Now execute an actual delete
                // Loop through all model types
                foreach ( $this->models as $model)
                {
                    // Check if a resource with a matching lake_guid exists
                    if ($m = $model::where('lake_guid', '=', $datum->lake_guid)->first())
                    {
                        // If it does, destroy the model and break
                        $this->warn( 'Deleting ' . $model . ' ' . $datum->lake_guid);
                        $m->delete();
                        break;
                    }
                }
            }

            $current++;

            // TODO: This structure causes an extra query to be run, when it might not need to be
            $json = $this->query( 'deletes', $current );
        }

    }

}
