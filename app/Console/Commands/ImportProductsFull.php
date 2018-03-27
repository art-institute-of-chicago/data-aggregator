<?php

namespace App\Console\Commands;

use DB;

class ImportProductsFull extends AbstractImportCommandNew
{

    protected $signature = 'import:products-full
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all product data";


    public function handle()
    {

        $this->api = env('SHOP_DATA_SERVICE_URL');

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

        $this->import(\App\Models\Shop\Product::class, 'products');
        $this->import(\App\Models\Shop\Category::class, 'categories');

        $this->info("Imported all products from data service!");

    }

}
