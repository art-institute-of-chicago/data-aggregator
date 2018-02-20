<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;

use App\Models\Dsc\Publication;
use App\Models\Dsc\Section;

class ImportCatalogues extends AbstractImportCommand
{

    protected $signature = 'import:dsc
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all catalogue data";


    public function handle()
    {

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

        $this->info("Truncated catalogue tables.", 'vv');

        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->info("Please manually ensure that your search index mappings are up-to-date.", 'vv');
        // $this->call("search:uninstall");
        // $this->call("search:install");

        $this->import(Publication::class, 'publications', 1);
        $this->import(Section::class, 'sections', 1);

        $this->info("Imported all Publications and Sections from data service!", 'vv');

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

    private function queryService($endpoint, $page = 1, $limit = 100)
    {
        return $this->query( env('DSC_DATA_SERVICE_URL', 'http://localhost') . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit );
    }

}
