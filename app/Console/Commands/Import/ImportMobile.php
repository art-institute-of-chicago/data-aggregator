<?php

namespace App\Console\Commands\Import;

use Illuminate\Support\Facades\Storage;

use App\Models\Mobile\Artwork as MobileArtwork;
use App\Models\Mobile\Sound;
use App\Models\Mobile\Tour;
use App\Models\Mobile\TourStop;

use App\Transformers\Traits\ConvertsToHtml;

class ImportMobile extends AbstractImportCommand
{
    use ConvertsToHtml;

    protected $signature = 'import:mobile {--no-download}';

    protected $description = 'Import all data from the mobile CMS';

    protected $filename = 'appData.json';

    public function handle()
    {
        if (!$this->option('no-download')) {
            $this->info('Retrieving events JSON from artic.edu');
            $contents = $this->fetch(env('MOBILE_JSON'));
            Storage::disk('local')->put($this->filename, $contents);
        }

        $contents = Storage::get($this->filename);
        $results = json_decode($contents);

        $this->importArtworks($results);
        $this->importSounds($results);
        $this->importTours($results);
    }

    private function importArtworks($results)
    {
        $this->info('Importing mobile artworks...');

        foreach ($results->objects as $datum) {
            $this->info("Importing artwork #{$datum->nid}: {$datum->title}");

            $id = (int) $datum->nid;
            $artwork = MobileArtwork::findOrNew($id);

            $artwork->mobile_id = $id;
            $artwork->title = $datum->title;

            $artwork->artwork_citi_id = $datum->id ?? $datum->object_id ?? null;

            $location = explode(', ', $datum->location);
            $artwork->latitude = (float) $location[0];
            $artwork->longitude = (float) $location[1];

            $artwork->sounds()->sync(collect($datum->audio_commentary)->pluck('audio')->all());

            $artwork->save();
        }
    }

    private function importSounds($results)
    {
        $this->info('Importing mobile sounds...');

        Sound::query()->delete();

        foreach ($results->audio_files as $datum) {
            $this->info("Importing audio #{$datum->nid}: {$datum->title}");

            $id = (int) $datum->nid;
            $sound = Sound::findOrNew($id);

            $sound->mobile_id = $id;
            $sound->title = $datum->title;

            $sound->web_url = env('MOBILE_AUDIO_CDN_URL') . array_slice(explode('/', $datum->audio_file_url), -1)[0];
            $sound->transcript = $this->convertToHtml($datum->audio_transcript);

            // Sounds are attached to Artworks on the Artwork side

            $sound->save();
        }
    }

    private function importTours($results)
    {
        $this->info('Importing mobile tours and tour stops...');

        Tour::query()->delete();

        foreach ($results->tours as $datum) {
            $this->info("Importing tour #{$datum->nid}: {$datum->title}");

            $id = (int) $datum->nid;
            $tour = Tour::findOrNew($id);

            $tour->mobile_id = $id;
            $tour->title = $datum->title;

            $tour->image = $datum->image_url;
            $tour->intro_text = $this->convertToHtml($datum->intro);
            $tour->description = $this->convertToHtml($datum->description);

            $tour->intro()->associate($datum->tour_audio);

            $tour->save();

            $this->importTourStops($datum->tour_stops, $tour);
        }
    }

    private function importTourStops($data, $tour)
    {
        $this->info("Flushing tour stops for tour #{$tour->mobile_id}...");

        TourStop::where('tour_mobile_id', $tour->mobile_id)->delete();

        $this->info("Importing tour stops for tour #{$tour->mobile_id}...");

        foreach ($data as $datum) {
            $this->info("Importing tour stop [ {$tour->mobile_id} / {$datum->object} / {$datum->audio_id} ]");

            $id = cantorTuple($datum->object, $datum->audio_id);

            $stop = TourStop::findOrNew($id);

            $stop->id = $id;
            $stop->weight = $datum->sort;

            $stop->tour()->associate($tour->mobile_id);
            $stop->artwork()->associate($datum->object);
            $stop->sound()->associate($datum->audio_id);

            $stop->save();
        }
    }
}
