<?php

namespace App\Console\Commands\Delete;

use Carbon\Carbon;
use App\Console\Commands\Import\AbstractImportCommand;

class DeleteAssets extends AbstractImportCommand
{

    protected $signature = 'delete:assets
                            {--since= : How far back to scan for records}
                            {--deep : Loop through the whole database}';

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

        if ($this->option('deep')) {
            $this->deep();
        } else {
            $this->shallow();
        }
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

        $json = $this->query('deletes', $current);
        $pages = $json->pagination->total_pages;

        $this->warn('Found ' . $pages . ' pages');

        while ($current <= $pages)
        {
            $this->warn('Deleting ' . $current . ' of ' . $pages);

            // Assumes the dataservice wraps its results in a `data` field
            foreach ($json->data as $datum)
            {
                // Break if we're past the last time we checked
                $sourceTime = new Carbon($datum->indexed_at);
                $sourceTime->timezone = config('app.timezone');

                if ($this->since->gt($sourceTime)) {
                    break 2;
                }

                // Now execute an actual delete
                // Loop through all model types
                foreach ($this->modelClasses as $modelClass)
                {
                    // Check if a resource with a matching lake_guid exists
                    if ($model = $modelClass::where('lake_guid', '=', $datum->lake_guid)->first())
                    {
                        // If it does, destroy the model and break
                        $this->warn('Deleting ' . $modelClass . ' ' . $datum->lake_guid);
                        $model->delete();
                        break;
                    }
                }
            }

            $current++;

            // TODO: This structure causes an extra query to be run, when it might not need to be
            $json = $this->query('deletes', $current);
        }
    }

    /**
     * Sometimes, assets get deleted in LAKE, but no "tombstone" record is generated in LPM Solr.
     * This is our work-around for those issues. We will loop through all of the models in our
     * database that come from LAKE, and delete any that do not exist in LPM Solr.
     */
    private function deep()
    {
        foreach ($this->modelClasses as $modelClass) {
            $endpoints = array_filter(config('resources.inbound.assets'), function($value) use ($modelClass) {
                return $value['model'] === $modelClass;
            });

            $endpoint = array_keys($endpoints)[0];

            $modelClass::select('lake_guid')->chunk(175, function ($models) use ($endpoint) {

                $url = $this->api . '/' . $endpoint . '?' . http_build_query([
                    'ids' => implode(',', $models->pluck('lake_guid')->all()),
                    'limit' => 175,
                    'flo' => 'id',
                    'quiet' => 1,
                ]);

                $result = $this->fetch($url, true);

                $validIds = collect($result->data)->pluck('id');

                if ($validIds->count() === 175) {
                    return;
                }

                $invalidModels = $models->filter(function($model) use ($validIds) {
                    return !$validIds->contains($model->lake_guid);
                });

                $invalidModels->each(function($model) {
                    $this->info($model->lake_guid);
                    $model->delete();
                });
            });
        }
    }
}
