<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;

class ImportLibrary extends AbstractImportCommandNew
{

    protected $signature = 'import:library
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all library data";


    public function handle()
    {

        $this->api = env('LIBRARY_DATA_SERVICE_URL');

        // Return false if the user bails out
        if (!$this->option('yes') && !$this->confirm("Running this will delete all existing library data from your database! Are you sure?"))
        {
            return false;
        }

        // Remove all library materials from the search index
        // $this->call("scout:flush", ['model' => \App\Models\Library\Material::class]);

        // Truncate tables
        DB::table('library_materials')->truncate();
        DB::table('library_terms')->truncate();

        $this->info("Truncated library tables.");

        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->info("Please manually ensure that your search index mappings are up-to-date.");
        // $this->call("search:uninstall");
        // $this->call("search:install");

        $this->import(\App\Models\Library\Material::class, 'materials');

        $this->info("Imported all library materials from data service!");

        $this->import(\App\Models\Library\Term::class, 'terms');

        $this->info("Imported all library terms from data service!");

    }

}
