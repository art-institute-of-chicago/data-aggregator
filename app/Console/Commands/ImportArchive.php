<?php

namespace App\Console\Commands;

use DB;

use App\Models\Archive\ArchiveImage;

class ImportArchive extends AbstractImportCommandNew
{

    protected $signature = 'import:archive
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all archives data";


    public function handle()
    {

        $this->api = env('ARCHIVES_DATA_SERVICE_URL');

        // Return false if the user bails out
        if (!$this->option('yes') && !$this->confirm("Running this will delete all existing archive data from your database! Are you sure?"))
        {
            return false;
        }

        // Remove all library materials from the search index
        //$this->call("scout:flush", ['model' => \App\Models\Archive\ArchiveImage::class]);

        // Truncate tables
        DB::table('archival_images')->truncate();

        $this->info("Truncated archive tables.");

        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->info("Please manually ensure that your search index mappings are up-to-date.");
        // $this->call("search:uninstall");
        // $this->call("search:install");

        $this->import( ArchiveImage::class, 'archival-images' );

        $this->info("Imported all archive images from data service!");

    }

}
