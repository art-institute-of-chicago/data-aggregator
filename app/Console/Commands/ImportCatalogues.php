<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;

use App\Models\Dsc\Publication;
use App\Models\Dsc\Section;

class ImportCatalogues extends AbstractImportCommandNew
{

    protected $signature = 'import:dsc
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all catalogue data";


    public function handle()
    {

        $this->api = env('DSC_DATA_SERVICE_URL');

        // Return false if the user bails out
        if (!$this->option('yes') && !$this->confirm("Running this will delete all existing catalogue data from your database! Are you sure?"))
        {
            return false;
        }

        // Remove all Publications and Sections from the search index
        $this->call("scout:flush", ['model' => Publication::class]);
        $this->call("scout:flush", ['model' => Section::class]);

        // Truncate tables
        DB::table('sections')->truncate();
        DB::table('publications')->truncate();

        $this->info("Truncated catalogue tables.");

        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->info("Please manually ensure that your search index mappings are up-to-date.");
        // $this->call("search:uninstall");
        // $this->call("search:install");

        $this->import(Publication::class, 'publications');
        $this->import(Section::class, 'sections');

        $this->info("Imported all Publications and Sections from data service!");

    }

}
