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

}
