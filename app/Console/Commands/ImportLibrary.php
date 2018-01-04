<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportLibrary extends AbstractImportCommand
{

    protected $signature = 'import:library';

    protected $description = "Import all library data";


    public function handle()
    {

        // Return false if the user bails out
        if (!$this->confirm("Running this will delete all existing library data from your database! Are you sure?"))
        {
            return false;
        }

        // Remove all library materials from the search index
        // $this->call("scout:flush", ['model' => \App\Models\Library\Material::class]);

        // Truncate all tables
        // $this->call("migrate:refresh");

        // Pseduo-refresh this specific migration...
        $migration = new \CreateLibraryTables();
        $migration->down();
        $migration->up();

        $this->info("Refreshed CreateLibraryTables migration.");

        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->warn("Please manually ensure that your search index mappings are up-to-date.");
        // $this->call("search:uninstall");
        // $this->call("search:install");

        $this->import(\App\Models\Library\Material::class, 'materials', 1);

        $this->info("Imported all library materials from data service!");

        $this->import(\App\Models\Library\Term::class, 'terms', 1);

        $this->info("Imported all library terms from data service!");

    }


    private function import($model, $endpoint, $current = 1)
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

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

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

    private function queryService($endpoint, $page = 1, $limit = 1000)
    {

        $url = env('LIBRARY_DATA_SERVICE_URL', 'http://localhost') . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit;

        $this->info( 'Querying: ' . $url );

        $result = $this->query( $url );

        if( is_null( $result ) ) {
            throw new \Exception("Cannot contact data service: " . $url);
        }

        return $result;

    }

}
