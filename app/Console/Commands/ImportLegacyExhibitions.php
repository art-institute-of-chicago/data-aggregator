<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\Collections\Exhibition;

class ImportLegacyExhibitions extends AbstractImportCommandNew
{

    protected $signature = "import:exhibitions-legacy
                            {--from-backup : Whether to use a previously retrieved version of Drupal's JSON data}";

    protected $description = "Import all exhibitions from legacy Drupal 7 CMS";

    protected $filename = 'drupal-7-exhibitions.json';


    public function handle()
    {

        if( !$this->option('from-backup') )
        {

            $this->info('Retrieving exhibitions JSON from artic.edu');

            $contents = $this->fetch( env('LEGACY_EXHIBITIONS_JSON') );

            Storage::disk('local')->put( $this->filename, $contents );

        }

        $contents = Storage::get( $this->filename );

        $results = json_decode( $contents );

        $this->importExhibitions( $results );

    }


    private function importExhibitions( $results )
    {

        $this->info("Importing legacy exhibitions");

        foreach( $results as $datum )
        {

            // Normalize title to remove HTML-encoded cruft
            $datum->title = html_entity_decode( $datum->title, ENT_COMPAT | ENT_QUOTES | ENT_HTML5 );
            $datum->title = $this->convert_smart_quotes( $datum->title );

            $exhib = $this->findExhibition( $datum );

            if( $exhib )
            {
                $this->updateExhibition( $exhib, $datum );

                $this->info('Updated exhibition: "' . $datum->title . '"');

            } else {

                $this->warn('Could not find exhibition: "' . $datum->title . '"');

            }

        }

    }

    private function findExhibition( $datum )
    {

        // First, try matching by title only
        $query = Exhibition::where('title', $datum->title);

        if( $query->count() === 1 )
        {
            return $query->first();
        }

        // If that fails, try matching by title *and* start date
        $dates = explode(' to ', $datum->date);

        if( count($dates) < 1 )
        {
            return null;
        }

        $date_start = new Carbon( $dates[0] );

        $query = Exhibition::where('title', $datum->title)->where('date_start', $date_start);

        if( $query->count() === 1 )
        {
            return $query->first();
        }

        return null;

    }

    private function updateExhibition( $exhib, $datum )
    {

        $exhib->short_description = $datum->short_description;
        $exhib->web_url = env('WEBSITE_URL') . $datum->path;

        if (!$exhib->description && $datum->body)
        {
            $exhib->description = $datum->body;
        }

        if ($datum->feature_image_desktop)
        {
            $exhib->legacy_image_desktop = $this->getImgSrc( $datum->feature_image_desktop );
        }

        if ($datum->feature_image_mobile)
        {
            $exhib->legacy_image_mobile = $this->getImgSrc( $datum->feature_image_mobile );
        }

        $exhib->save();


    }

    // http://php.net/manual/en/domdocument.getelementsbytagname.php
    private function getImgSrc( $html )
    {

        $dom = new \DOMDocument();
        @$dom->loadHTML( $html );

        $nodes = $dom->getElementsByTagName('img');

        if( $nodes->length === 0 )
        {
            return null;
        }

        return $nodes->item(0)->getAttribute('src');

    }

    // Standardize apostrophes etc into quote characters
    // https://stackoverflow.com/questions/42932839/how-to-replace-apostrophe-with-single-quote
    private function convert_smart_quotes($string)
    {
        $search = [
            '’',
            chr(145),
            chr(146),
            chr(147),
            chr(148),
            chr(151),
        ];

        $replace = [
            "'",
            "'",
            "'",
            '"',
            '"',
            '-',
        ];

        return str_replace($search, $replace, $string);
    }

}
