<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;

class ImportArchive extends AbstractImportCommand
{

    protected $signature = 'import:archive
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all archives data";


    public function handle()
    {

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

        $this->import(\App\Models\Archive\ArchiveImage::class, 'archival-images', 1);

        $this->info("Imported all archive images from data service!");

    }


    private function import($model, $endpoint, $current = 1)
    {

        // Abort if the table is already filled
        if( $model::count() > 0 )
        {
            return false;
        }

        // Query for the first page + get page count
        $json = $this->queryService($endpoint, $current);

        $pages = $json->pagination->total_pages;

        while ($current <= $pages)
        {

            foreach ($json->data as $source)
            {
                $this->saveDatum( $source, $model );
            }

            $current++;

            $json = $this->queryService($endpoint, $current);

        }

    }

    private function queryService($endpoint, $page = 1, $limit = 1000)
    {

        $url = env('ARCHIVES_DATA_SERVICE_URL', 'http://localhost') . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit;

        $this->info( 'Querying: ' . $url );

        $result = $this->query( $url );

        if( is_null( $result ) ) {
            throw new \Exception("Cannot contact data service: " . $url);
        }

        return $result;

    }

}
