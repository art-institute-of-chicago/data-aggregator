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

        // Truncate tables
        DB::table('artwork_site')->truncate();
        DB::table('agent_site')->truncate();
        DB::table('exhibition_site')->truncate();
        DB::table('sites')->truncate();

        $this->info("Truncated sites tables.");

        Storage::disk('local')->put('archive.json', file_get_contents(env('STATIC_ARCHIVE_JSON', 'http://localhost/archive.json')));

        $contents = Storage::get('archive.json');

        $results = json_decode( $contents );

        $this->importSites( $results->data );

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
