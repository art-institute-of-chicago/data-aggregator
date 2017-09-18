<?php

namespace App\Console\Commands;

use Carbon\Carbon;

use App\Models\Collections\Artwork as BaseArtwork;

use App\Models\Mobile\Artwork as MobileArtwork;
use App\Models\Mobile\Sound;
use App\Models\Mobile\Tour;
use App\Models\Mobile\TourStop;


class ImportMobile extends AbstractImportCommand
{

    protected $signature = 'import:mobile';

    protected $description = "Import all data from the mobile CMS";


    public function handle()
    {

        // Spoofing this w/ local file for speed
        $contents = \Storage::get('appData.json');

        $results = json_decode( $contents );

        // We need to turn off foreign key checks, since we will be e.g. attaching sound ids
        // to mobile artworks before the mobile sounds have been imported.
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // There's no unique data coming re: galleries from the mobile app AFAICT

        $this->importArtworks( $results );
        // $this->importSounds( $results );
        // $this->importTours( $results );
        // $this->importTourStops( $results );

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

    private function importArtworks( $results )
    {

        $this->info("Importing mobile artworks...");

        foreach( $results->objects as $datum )
        {

            $this->warn("Importing artwork #{$datum->nid}: {$datum->title}");

            // Ex: 41.8794289180879, -87.6236425536961
            $location = explode(', ', $datum->location);

            $artwork = MobileArtwork::findOrNew( (int) $datum->nid );

            // For now, we will create an artwork by the CITI ID if it doesn't exist
            // $base = BaseArtwork::findOrCreate( (int) $datum->object_id );

            $artwork->mobile_id = (int) $datum->nid;
            $artwork->title = $datum->title;

            // $artwork->artwork()->attach( $base );
            // $artwork->artwork()->associate( $base );
            $artwork->artwork_citi_id = $datum->object_id;

            // Pull in an actual model
            // $artwork->artwork_citi_id = (int) $datum->object_id,

            $artwork->sounds()->attach( $datum->audio );

            $artwork->latitude = (float) $location[0];
            $artwork->longitude = (float) $location[1];

            $artwork->highlighted = (bool) $datum->highlighted_object;
            $artwork->selector_number = isset( $datum->object_selector_number ) ? (bool) $datum->object_selector_number : null;

            $artwork->save();

        }

    }


    // They are.
    private function checkIfObjectsAndAudioFilesAreM2M( $results )
    {

        $audios = collect( $results->objects )->pluck('audio');

        $combined = collect([]);

        foreach( $audios as $audio ) {
            $combined = $combined->merge( $audio );
        }

        $counts = array_count_values( $combined->toArray() );

        $files = collect( $results->audio_files );

        $one = [];
        $none = [];
        $many = [];

        foreach( $files as $file ) {

            if( !isset( $counts[ $file->nid ] ) ) {
                array_push( $none, $file->nid );
                continue;
            }

            switch( $counts[ $file->nid ] ) {
                case 1:
                    array_push( $one, $file->nid );
                break;
                default:
                    array_push( $many, $file->nid );
                break;
            }

        }

        $results = [
            'many' => $many,
            'none' => $none,
            'one' => $one,
        ];


        dd( $results );

    }

}
