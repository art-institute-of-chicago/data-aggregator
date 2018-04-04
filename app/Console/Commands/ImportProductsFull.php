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

    public function handle()
    {

        $this->api = env('SHOP_DATA_SERVICE_URL');

        $hasReset = $this->reset(
            [
                Product::class,
                Category::class,
            ],
            [
                'products',
                'shop_categories',
            ]
        );

        if( !$hasReset )
        {
            return false;
        }

        $this->import( Product::class, 'products' );
        $this->import( Category::class, 'categories' );

    }

    protected function reset( $modelsToFlush, $tablesToClear )
    {

        // Return false if the user bails out
        if ( !$this->confirmReset() )
        {
            return false;
        }

        // Ensure the arguments are arrays
        $modelsToFlush = is_array( $modelsToFlush ) ? $modelsToFlush : [ $modelsToFlush ];
        $tablesToClear = is_array( $tablesToClear ) ? $tablesToClear : [ $tablesToClear ];

        // TODO: If we dump the indexes + recreate them, we don't need to flush
        foreach( $modelsToFlush as $model )
        {
            $this->call("scout:flush", ['model' => $model]);
            $this->info("Flushed from search index: `{$model}`");
        }

        // TODO: We'd like to affect related models – consider doing an Eloquent delete instead
        // It's much slower, but it'll ensure better data integrity
        foreach( $tablesToClear as $table )
        {
            DB::table($table)->truncate();
            $this->info("Truncated `{$table}` table.");
        }

        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->info("Please manually ensure that your search index mappings are up-to-date.");
        // $this->call("search:uninstall");
        // $this->call("search:install");

        return true;

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
