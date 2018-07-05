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

        $current = 1;

        $json = $this->query('deletes', $current);
        $pages = $json->pagination->total_pages;

        $this->warn( 'Found ' . $pages . ' pages' );

        while( $current <= $pages )
        {

            $this->warn( 'Deleteing ' . $current . ' of ' . $pages);

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
                        $this->warn( 'Deleteing ' . $model . ' ' . $datum->lake_guid);
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
