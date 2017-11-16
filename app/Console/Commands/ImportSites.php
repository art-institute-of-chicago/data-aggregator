<?php

namespace App\Console\Commands;

use Storage;
use DB;
use Carbon\Carbon;
use App\Models\StaticArchive\Site;

class ImportSites extends AbstractImportCommand
{

    protected $signature = "import:sites";

    protected $description = "Import all historic microsites";


    public function handle()
    {

        // Return false if the user bails out
        if (!$this->confirm("Running this will delete all existing sites data from your database! Are you sure?"))
        {
            return false;
        }

        // Remove all Publications and Sections from the search index
        $this->call("scout:flush", ['model' => Site::class]);

        // Pseduo-refresh this specific migration...
        $migration = new \CreateStaticArchiveTables();
        $migration->down();
        $migration->up();

        $this->info("Refreshed \CreateStaticArchiveTables migration.");

        Storage::disk('local')->put('archive.json', file_get_contents(env('STATIC_ARCHIVE_JSON', 'http://localhost/archive.json')));

        $contents = Storage::get('archive.json');

        $results = json_decode( $contents );

        // // We need to turn off foreign key checks, since we will be e.g. attaching sound ids
        // // to mobile artworks before the mobile sounds have been imported.
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->importSites( $results->data );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }


    private function importSites( $results )
    {

        $this->info("Importing static sites");

        foreach( $results as $datum )
        {

            $this->saveDatum( $datum, \App\Models\StaticArchive\Site::class );

        }

    }

}
