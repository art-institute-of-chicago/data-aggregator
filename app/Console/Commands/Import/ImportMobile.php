<?php

namespace App\Console\Commands\Import;

use Illuminate\Support\Facades\Storage;

use App\Models\Collections\Artwork as BaseArtwork;

use App\Models\Mobile\Artwork as MobileArtwork;
use App\Models\Mobile\Sound;
use App\Models\Mobile\Tour;
use App\Models\Mobile\TourStop;

class ImportMobile extends AbstractImportCommand
{

    protected $signature = 'import:mobile';

    protected $description = "Import all data from the mobile CMS";

    protected $filename = 'appData.json';


    public function handle()
    {

        $this->info('Retrieving events JSON from artic.edu');

        $contents = $this->fetch( env('MOBILE_JSON') );

        Storage::disk('local')->put($this->filename, $contents);

        // Spoofing this w/ local file for speed
        $contents = Storage::get($this->filename);

        $results = json_decode( $contents );

        // There's no unique data coming re: galleries from the mobile app AFAICT

        $this->importArtworks( $results );
        $this->importSounds( $results );
        $this->importTours( $results );
        // TourStops are imported inside importTours()

    }


    private function importArtworks( $results )
    {

        $this->info("Importing mobile artworks...");

        foreach( $results->objects as $datum )
        {

            $this->info("Importing artwork #{$datum->nid}: {$datum->title}");

            // Ex: 41.8794289180879, -87.6236425536961
            $location = explode(', ', $datum->location);

            $artwork = MobileArtwork::findOrNew( (int) $datum->nid );

            $artwork->mobile_id = (int) $datum->nid;
            $artwork->title = $datum->title;

            // $artwork->artwork()->attach( $base );
            // $artwork->artwork()->associate( $base );
            $artwork->artwork_citi_id = $datum->object_id ?? null;

            // Pull in an actual model
            // $artwork->artwork_citi_id = (int) $datum->object_id,

            // In some rare cases the mobile app returns this value as an array of obejcts instead of an array of
            // simple integers. We'll account for both:
            if ($datum->audio == array_filter($datum->audio, 'is_numeric'))
            {

                // https://stackoverflow.com/questions/17472128/preventing-laravel-adding-multiple-records-to-a-pivot-table
                $artwork->sounds()->sync( $datum->audio, false );

            }
            else
            {

                $artwork->sounds()->sync( collect($datum->audio)->pluck('audio')->all(), false );

            }

            $artwork->latitude = (float) $location[0];
            $artwork->longitude = (float) $location[1];

            $artwork->selector_number = $datum->object_selector_number ?? null;

            $artwork->save();

        }

    }


    private function importSounds( $results )
    {

        $this->info("Importing mobile sounds...");

        foreach( $results->audio_files as $datum )
        {

            $this->info("Importing audio #{$datum->nid}: {$datum->title}");

            $sound = Sound::findOrNew( (int) $datum->nid );

            $sound->mobile_id = (int) $datum->nid;
            $sound->title = $datum->title;

            $sound->link = $datum->audio_file_url;
            $sound->transcript = $datum->audio_transcript;

            $sound->save();

            // Sounds are attached to Artworks on the Artwork side

        }

    }


    private function importTours( $results )
    {

        $this->info("Importing mobile tours and tour stops...");

        foreach( $results->tours as $datum )
        {

            $this->info("Importing tour #{$datum->nid}: {$datum->title}");

            $tour = Tour::findOrNew( (int) $datum->nid );

            $tour->mobile_id = (int) $datum->nid;
            $tour->title = $datum->title;

            $tour->image = $datum->image_url;
            $tour->intro_text = $datum->intro;
            $tour->description = $datum->description;

            $tour->intro()->associate( $datum->tour_audio );

            $tour->save();

            $this->importTourStops( $datum->stops, $tour );

        }

    }


    private function importTourStops( $data, $tour )
    {

        $this->info("Flushing tour stops for tour #{$tour->mobile_id}...");

        TourStop::where('tour_mobile_id', $tour->mobile_id)->delete();

        $this->info("Importing tour stops for tour #{$tour->mobile_id}...");

        foreach( $data as $datum )
        {

            $this->info("Importing tour stop [ {$tour->mobile_id} / {$datum->object} / {$datum->audio} ]");

            $stop = new TourStop();

            $stop->tour()->associate( $tour->mobile_id );
            $stop->artwork()->associate( $datum->object );
            $stop->sound()->associate( $datum->audio );

            $stop->weight = $datum->sort;

            $stop->save();

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
