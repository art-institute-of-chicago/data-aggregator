<?php

namespace App\Console\Commands\Import;

use App\Models\Shop\Product;

class ImportProductsFull extends AbstractImportCommand
{

    protected $signature = 'import:products-full
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = 'Import all product data';

    public function handle()
    {
        $this->api = env('SHOP_DATA_SERVICE_URL');

        if (!$this->reset()) {
            return false;
        }

        $this->importResources();
    }

    protected function reset()
    {
        return $this->resetData(
            [
                Product::class,
            ],
            [
                'products',
            ]
        );
    }

    protected function importResources()
    {
        $this->import('Shop', Product::class, 'products');
    }
}
