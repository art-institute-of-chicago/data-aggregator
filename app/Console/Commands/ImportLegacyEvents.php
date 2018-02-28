<?php

namespace App\Console\Commands;

use Storage;
use Carbon\Carbon;
use App\Models\Membership\LegacyEvent;

class ImportLegacyEvents extends AbstractImportCommand
{

    protected $signature = "import:events-legacy
                            {--from-backup : Whether to use a previously retrieved version of Drupal's JSON data}";

    protected $description = "Import all events from legacy Drupal 7 CMS";


    public function handle()
    {

        $fromBackup = $this->option('from-backup');

        if (!$fromBackup)
        {

            $this->info('Retrieving events JSON from artic.edu');
            Storage::disk('local')->put('drupal-7-events.json', file_get_contents(env('LEGACY_EVENTS_JSON', 'http://localhost/events.json')));

        }
        $contents = Storage::get('drupal-7-events.json');

        $results = json_decode( $contents );

        $this->importEvents( $results );

    }


    private function importEvents( $results )
    {

        $this->info("Importing legacy events");

        foreach( $results as $datum )
        {

            $datum->id = $this->cantorPair( $datum->nid, $datum->repeat_delta );
            $this->saveDatum( $datum, \App\Models\Membership\LegacyEvent::class );

        }

    }


    /**
     * Generate a unique ID based on a combination of two numbers.
     * @param  int   $x
     * @param  int   $y
     * @return int
     */
    public function cantorPair($x, $y)
    {

        return (($x + $y) * ($x + $y + 1)) / 2 + $y;

    }

}
