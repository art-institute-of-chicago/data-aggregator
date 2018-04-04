<?php

namespace App\Console\Commands;

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

        if( !$this->reset() )
        {
            return false;
        }

        $this->importResources();

    }

    protected function reset()
    {

        return $this->resetData(
            [
                Product::class,
                Category::class,
            ],
            [
                'products',
                'shop_categories',
            ]
        );

    }

    protected function importResources()
    {

        $this->import( Product::class, 'products' );
        $this->import( Category::class, 'categories' );

    }

}
