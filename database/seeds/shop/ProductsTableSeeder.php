<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Models\Shop\Product::class, 100)->create();

        $this->_addCategoriesToProducts();

    }

    private function _addCategoriesToProducts()
    {

        $products = App\Models\Shop\Product::all()->all();
        $categoryIds = App\Models\Shop\Category::all()->pluck('shop_id')->all();

        foreach ($products as $product) {

            $ids = [];

            for ($i = 0; $i < rand(2,8); $i++) {

                $id = $categoryIds[array_rand($categoryIds)];

                if (!in_array($id, $ids)) {
                    $product->categories()->attach($id);
                    $ids[] = $id;
                }

            }

        }

    }

}
