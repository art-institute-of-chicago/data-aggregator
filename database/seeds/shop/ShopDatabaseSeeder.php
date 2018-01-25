<?php

use App\Models\Shop\Category;
use App\Models\Shop\Product;

class ShopDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(ShopCategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);

    }

    protected static function unseed()
    {

        Category::fake()->delete();
        Product::fake()->delete();

    }

}
