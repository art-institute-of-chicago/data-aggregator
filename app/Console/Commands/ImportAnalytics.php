<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;

use League\Csv\Reader;
use League\Csv\Statement;

use App\Models\Collections\Artwork;

class ImportAnalytics extends AbstractImportCommand
{

    protected $signature = 'import:analytics';

    protected $description = "Import analytic pageviews for artworks ";

    protected static $filename = 'artwork-pageviews.csv';


    public function handle()
    {

        // Check if the file exists
        if( !Storage::exists(self::$filename) )
        {
            $this->warn('Could not find ' . $this->getCsvPath());
            return;
        }

        // Spoofing this w/ local file for speed
        $contents = Storage::get(self::$filename);

        $this->csv = Reader::createFromPath( $this->getCsvPath(), 'r' );

        // What line the header's at
        $this->csv->setHeaderOffset(5);

        // Offset past the comment
        $stmt = (new Statement())->offset(5);

        $records = $stmt->process($this->csv);

        foreach( $records as $record )
        {

            $citi_id = (int) substr( $record['Page'], 25 );

            $artwork = Artwork::find( $citi_id );

            if( !$artwork ) {
                $this->warn( 'Not found: ' . $citi_id );
                continue;
            }

            $artwork->pageviews = (int) str_replace(',', '', $record['Pageviews']);
            $artwork->save();

            $this->info( "Artwork {$artwork->citi_id} pageviews: {$artwork->pageviews}");

        }


    }

    protected function getCsvPath()
    {

        return Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . self::$filename;

    }

}
