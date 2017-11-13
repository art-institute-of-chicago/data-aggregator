<?php

use App\Models\Shop\Product;
use App\Models\Shop\Category;

class ProductsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Product::class, 25 )->create();

        $this->_addCategoriesToProducts();

    }

    private function _addCategoriesToProducts()
    {

        $products = Product::fake()->get();
        $categoryIds = Category::fake()->pluck('shop_id')->all();

        foreach ($products as $product) {

            $ids = [];

            for ($i = 0; $i < rand(2,4); $i++) {

                $id = $categoryIds[array_rand($categoryIds)];

                if (!in_array($id, $ids)) {
                    $product->categories()->attach($id);
                    $ids[] = $id;
                }

            }

        }

    }

}
