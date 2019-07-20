<?php

use App\Models\Shop\Product;
use App\Models\Shop\Category;

class ProductsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory(Product::class, 25)->create();

        $this->seedRelation(Product::class, Category::class, 'categories');

    }

}
