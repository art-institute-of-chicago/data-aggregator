<?php

use App\Models\Shop\Category;

class ShopCategoriesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory( Category::class, 25 )->create();

        $categories = Category::fake()->get()->all();
        $categoryIds = Category::fake()->pluck('shop_id')->all();

        foreach ($categories as $category) {

            $child = $categories[array_rand($categories)];

            if ($child != $category) {
                $category->children()->save($child);
            }

        }

    }

}
