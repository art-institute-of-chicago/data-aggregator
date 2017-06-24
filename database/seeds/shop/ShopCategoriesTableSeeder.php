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

            $child = $categories[array_rand($categories)];

            if ($child != $category) {
                $category->children()->save($child);
            }

        }

    }

}
