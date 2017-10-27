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

        factory(App\Models\Shop\Category::class, 25)->create();

        $categories = App\Models\Shop\Category::fake()->get()->all();
        $categoryIds = App\Models\Shop\Category::fake()->pluck('shop_id')->all();

        foreach ($categories as $category) {

            $child = $categories[array_rand($categories)];

            if ($child != $category) {
                $category->children()->save($child);
            }

        }

    }

}
