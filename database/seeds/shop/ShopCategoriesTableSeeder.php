<?php

use Illuminate\Database\Seeder;

class ShopCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Shop\Category::class, 100)->create();

        $categories = App\Shop\Category::all()->all();
        $categoryIds = App\Shop\Category::all()->pluck('shop_id')->all();

        foreach ($categories as $category) {

            for ($i = 0; $i < rand(2,8); $i++) {

                $categoryId = $categoryIds[array_rand($categoryIds)];

                if ($categoryId != $category->getKey()) {
                    $category->children()->save(App\Shop\Category::find($categoryId));
                }
                
            }

        }

    }
}
