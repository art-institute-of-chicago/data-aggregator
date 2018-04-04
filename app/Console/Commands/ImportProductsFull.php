<?php

namespace App\Console\Commands;

use DB;

use App\Models\Shop\Product;
use App\Models\Shop\Category;

class ImportProductsFull extends AbstractImportCommandNew
{

    protected $signature = 'import:products-full
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all product data";

    protected $tablesToTruncate = [
        'products',
        'shop_categories',
    ];

    protected $modelsToFlush = [
        Product::class,
        Category::class,
    ];

    public function handle()
    {

        $this->api = env('SHOP_DATA_SERVICE_URL');

        // Return false if the user bails out
        if ( !$this->confirmReset() )
        {
            return false;
        }

        foreach( $this->modelsToFlush as $model )
        {
            $this->call("scout:flush", ['model' => $model]);
            $this->info("Flushed from search index: `{$model}`");
        }

        // TODO: We'd like to affect related models – consider doing an Eloquent delete instead
        // It's much slower, but it'll ensure better data integrity
        foreach( $this->tablesToTruncate as $table )
        {
            DB::table($table)->truncate();
            $this->info("Truncated `{$table}` table.");
        }


        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->info("Please manually ensure that your search index mappings are up-to-date.");
        // $this->call("search:uninstall");
        // $this->call("search:install");

        $this->import( Product::class, 'products' );
        $this->import( Category::class, 'categories' );

    }

    protected function confirmReset()
    {

        return (
            !$this->hasOption('yes') || $this->option('yes')
        ) || (
            // TODO: Make this less generic?
            $this->confirm("Running this will fully overwrite some tables in your database! Are you sure?")
        );

    }
}
