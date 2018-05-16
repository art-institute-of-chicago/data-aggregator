<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;

use App\Models\Membership\LegacyEvent;

class ImportLegacyEvents extends AbstractImportCommand
{

    protected $signature = "import:events-legacy
                            {--from-backup : Whether to use a previously retrieved version of Drupal's JSON data}";

    protected $description = "Import all events from legacy Drupal 7 CMS";

    protected $filename = 'drupal-7-events.json';


    public function handle()
    {

        if( !$this->option('from-backup') )
        {

            $this->info('Retrieving events JSON from artic.edu');

            $contents = $this->fetch( env('LEGACY_EVENTS_JSON') );

            Storage::disk('local')->put( $this->filename, $contents );

        }

        $contents = Storage::get( $this->filename );

        $results = json_decode( $contents );

        $this->importEvents( $results );

    }


    private function importEvents( $results )
    {

        $this->info("Importing legacy events");

        $transformer = app('Resources')->getInboundTransformerForModel( LegacyEvent::class, 'Membership' );

        foreach( $results as $datum )
        {

            $datum->id = $this->cantorPair( $datum->nid, $datum->repeat_delta );

            $this->save( $datum, LegacyEvent::class, $transformer );

        }

    }


    /**
     * Generate a unique ID based on a combination of two numbers.
     *
     * @TODO Consider moving this to `app/Helpers/Util.php`
     *
     * @param  int   $x
     * @param  int   $y
     * @return int
     */
    public function cantorPair($x, $y)
    {

        return (($x + $y) * ($x + $y + 1)) / 2 + $y;

    }

}
