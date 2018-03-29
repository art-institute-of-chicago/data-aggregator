<?php

namespace App\Console\Commands;

use App\Models\Shop\Product;

class ImportProducts extends AbstractImportCommandNew
{

    protected $signature = 'import:products';

    protected $description = "Import products data that has been updated since the last import";

    protected $isPartial = true;

    public function handle()
    {

        $this->api = env('SHOP_DATA_SERVICE_URL');

        $this->import( Product::class, 'products' );

    }

}
