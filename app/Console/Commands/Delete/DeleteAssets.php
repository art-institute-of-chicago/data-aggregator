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
    protected $modelClasses = [
        \App\Models\Collections\Image::class,
        \App\Models\Collections\Sound::class,
        \App\Models\Collections\Text::class,
        \App\Models\Collections\Video::class,
    ];

    public function handle()
    {
        $this->api = env('ASSETS_DATA_SERVICE_URL');
        $this->shallow();
    }

    /**
     * LAKE creates "tombstone" records with `deleted:true` for any record that has been
     * unpublished. These records are minimal, containing only the timestamp, deleted
     * status, and the LAKE UUID. This function will loop through all tombstone records
     * ordered by timestamp descending until it reaches one that's older than its last
     * successful run. It'll take the UUID of each record, loop through the `$models`
     * until it finds a match, and delete that record.
     */
    private function shallow()
    {
        $current = 1;

        $json = $this->query('deletions', $current);
        $pages = $json->pagination->total_pages;

        $this->warn('Found ' . $pages . ' pages');

        while ($current <= $pages) {
            $this->warn('Deleting ' . $current . ' of ' . $pages);

            // Assumes the dataservice wraps its results in a `data` field
            foreach ($json->data as $datum) {
                // Break if we're past the last time we checked
                $sourceModifiedAt = new Carbon($datum->modified_at);
                $sourceModifiedAt->timezone = config('app.timezone');

                if ($this->since->gt($sourceModifiedAt)) {
                    break 2;
                }

                $sourceDeletedAt = new Carbon($datum->source_deleted_at);
                $sourceDeletedAt->timezone = config('app.timezone');

                // Loop through all model types
                foreach ($this->modelClasses as $modelClass) {
                    // Check if a resource with a matching lake_guid exists
                    if ($model = $modelClass::where('lake_guid', '=', $datum->asset_id)->first()) {
                        // Check that the resource was modified at or before the delete
                        if ($model->source_modified_at->lte($sourceDeletedAt)) {
                            $this->warn('Deleting ' . $modelClass . ' ' . $datum->asset_id);
                            $model->delete();
                            break;
                        } else {
                            $this->info('Skipped ' . $modelClass . ' ' . $datum->asset_id . ' because it is newer');
                        }
                    }
                }
            }

            $current++;

            // TODO: This structure causes an extra query to be run, when it might not need to be
            $json = $this->query('deletions', $current);
        }
    }
}
