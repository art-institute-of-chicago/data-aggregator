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

        // There's no unique data coming re: galleries from the mobile app AFAICT

        foreach( $results->objects as $datum )
        {

            $this->info("Importing artwork #{$datum->nid}: {$datum->title}");

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

            $artwork->latitude = (float) $location[0];
            $artwork->longitude = (float) $location[1];

            $artwork->highlighted = (bool) $datum->highlighted_object;
            $artwork->selector_number = isset( $datum->object_selector_number ) ? (bool) $datum->object_selector_number : null;

            $artwork->save();

        }

    }

}
