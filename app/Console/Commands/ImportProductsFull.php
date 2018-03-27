<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;

class ImportProductsFull extends AbstractImportCommand
{

    protected $signature = 'import:products-full
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all product data";


    public function handle()
    {

        // Return false if the user bails out
        if (!$this->option('yes') && !$this->confirm("Running this will delete all existing products from your database! Are you sure?"))
        {
            return false;
        }

        // Remove all events from the search index
        $this->call("scout:flush", ['model' => \App\Models\Shop\Product::class]);

        // Truncate tables
        DB::table('products')->truncate();
        DB::table('shop_categories')->truncate();

        $this->info("Truncated product table.");

        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->info("Please manually ensure that your search index mappings are up-to-date.");
        // $this->call("search:uninstall");
        // $this->call("search:install");

        $this->import('products');
        $this->import('categories');

        $this->info("Imported all products from data service!");

    }


    private function import($endpoint, $current = 1)
    {

        $model = \App\Models\Shop\Product::class;
        if ($endpoint == 'categories')
        {

            $model = \App\Models\Shop\Category::class;

        }

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
        $this->info(env('SHOP_DATA_SERVICE_URL') . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit);
        return $this->query( env('SHOP_DATA_SERVICE_URL') . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit );
    }

}
