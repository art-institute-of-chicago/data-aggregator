<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class DeleteCollectionsRecords extends AbstractImportCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:collections-delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete records that have been removed from the source system';

    /**
     * For id-based deletes, how many to check at a time.
     *
     * @var int
     */
    protected $size = 100;

    /**
     * Which models to cross-reference against tombstones.
     *
     * @var array
     */
    protected $models = [
        \App\Models\Collections\ArtworkPlaceQualifier::class,
        \App\Models\Collections\ArtworkDateQualifier::class,
        \App\Models\Collections\AgentRole::class,
        \App\Models\Collections\ArtworkType::class,
        \App\Models\Collections\AgentType::class,
        \App\Models\Collections\Agent::class,
        \App\Models\Collections\Category::class,
        \App\Models\Collections\Term::class,
        \App\Models\Collections\Place::class,
        \App\Models\Collections\Gallery::class,
        \App\Models\Collections\Catalogue::class,
        \App\Models\Collections\Image::class,
        \App\Models\Collections\Sound::class,
        \App\Models\Collections\Text::class,
        \App\Models\Collections\Video::class,
        \App\Models\Collections\Artwork::class,
        \App\Models\Collections\Exhibition::class,
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->api = env('COLLECTIONS_DATA_SERVICE_URL');

        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->deleteByTombstone();

        // Galleries can be unpublished via "untagging"
        $this->deleteById(\App\Models\Collections\Gallery::class);
    }

    /**
     * LAKE creates "tombstone" records with `deleted:true` for any record that has been
     * unpublished. These records are minimal, containing only the timestamp, deleted
     * status, and the LAKE UUID. This function will loop through all tombstone records
     * ordered by timestamp descending until it reaches one that's older than its last
     * successful run. It'll take the UUID of each record, loop through the `$models`
     * until it finds a match, and delete that record.
     */
    private function deleteByTombstone()
    {

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

                if( $this->command->last_success_at->gt( $sourceTime ) )
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

    /**
     * This is how we used to handle deletes, before LAKE created "tombstone" records.
     * For each model, we take all of the UUIDs (in batches), and issue a multi-id
     * query to LAKE via the CDS. We then loop through the results, and check if there
     * are any ids in our query set that aren't in the results. If so, we delete those
     * records.
     *
     * This function still has a purpose, despite being less effecient than the tombstone
     * one. In certain cases, models are "untagged" rather than being unpublished. When
     * this happens, LAKE doesn't generate a tombstone for them, even though they are no
     * longer picked up by our LPM Solr query filters. They become orphaned in our system.
     */
    private function deleteById($model, $endpoint = null)
    {
        if (!$endpoint)
        {
            $endpoint = app('Resources')->getEndpointForModel($model);
        }

        $size = $this->size;

        // Try to not go over any potential URL-length limits
        if ($model::instance()->getKeyName() == 'lake_guid')
        {
            $size = $size / 10;
        }

        $model::chunk($size, function ($resources) use ($model, $endpoint) {

            $this->info( 'Working on ' . $endpoint . ' starting at ' .$resources->pluck($model::instance()->getKeyName())->first());

            // Get a list of CITI IDs of works in the Data Aggregator
            $daIds = $resources->pluck($model::instance()->getKeyName());

            $url = env('COLLECTIONS_DATA_SERVICE_URL') . '/' . $endpoint . '?' . http_build_query([
                'flo' => 'id',
                'limit' => $this->size,
                'ids' => implode(',', $daIds->all()),
            ]);

            $contents = file_get_contents( $url, false, stream_context_create([
              'http'=> [
                  'timeout' => 120,  //120 Seconds is 2 Minutes
              ]
            ]));

            $json = json_decode( $contents );

            $cdsIds = collect($json->data)->pluck('id');

            // Compare those two lists, and delete anything in the Data Hub that's not in the CSD
            $diff = $daIds->diff($cdsIds)->all();

            if ($diff)
            {
                $this->warn( 'Deleting ' . implode(',', $diff) );
                $model::destroy($diff);
            }

        });

    }

}
