<?php

namespace App\Console\Commands;

use Storage;
use Carbon\Carbon;
use App\Models\Collections\Exhibition;

class ImportLegacyExhibitions extends AbstractImportCommand
{

    protected $signature = "import:exhibitions-legacy
                            {--from-backup : Whether to use a previously retrieved version of Drupal's JSON data}";

    protected $description = "Import all exhibitions from legacy Drupal 7 CMS";


    public function handle()
    {

        $fromBackup = $this->option('from-backup');

        if (!$fromBackup)
        {

            $this->info('Retrieving exhibitions JSON from artic.edu');
            Storage::disk('local')->put('drupal-7-exhibitions.json', file_get_contents(env('LEGACY_EXHIBITIONS_JSON', 'http://localhost/exhibitions.json')));

        }
        $contents = Storage::get('drupal-7-exhibitions.json');

        $results = json_decode( $contents );

        $this->importExhibitions( $results );

    }


    private function importExhibitions( $results )
    {

        $this->info("Importing legacy exhibitions");

        foreach( $results as $datum )
        {

            $datum->title = html_entity_decode($datum->title, ENT_COMPAT | ENT_QUOTES | ENT_HTML5);

            // Find a matching exhibitions. If there are multiple matches, skip it.
            $query = Exhibition::where('title', $datum->title);
            if ($query->count() > 1)
            {

                $dates = explode(' to ', $datum->date);
                if (count($dates) > 0)
                {

                    $query = Exhibition::where('title', $datum->title)
                                  ->where('date_start', new Carbon($dates[0]));

                    if ($query->count() > 1)
                    {

                        continue;

                    }

                }

            }

            if ($query->count() == 1)
            {

                $exhib = $query->first();
                $exhib->short_description = $datum->short_description;
                $exhib->web_url = env('WEBSITE_URL', 'http://localhost') .$datum->path;

                if (!$exhib->description && $datum->body)
                {

                    $exhib->description = $datum->body;

                }

                if ($datum->feature_image_desktop)
                {

                    $dom = new \DOMDocument();
                    @$dom->loadHTML($datum->feature_image_desktop);
                    foreach ($dom->getElementsByTagName('img') as $img)
                    {

                        $exhib->legacy_image_desktop = $img->getAttribute('src');

                    }

                }

                if ($datum->feature_image_mobile)
                {

                    $dom = new \DOMDocument();
                    @$dom->loadHTML($datum->feature_image_mobile);
                    foreach ($dom->getElementsByTagName('img') as $img)
                    {

                        $exhib->legacy_image_mobile = $img->getAttribute('src');

                    }

                }
                $exhib->save();

            }

        }

    }

}
