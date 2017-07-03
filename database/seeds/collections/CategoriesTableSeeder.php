<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Collections\Category::class, 100)->create();

        $categories = App\Collections\Category::all()->all();
        $categoryIds = App\Collections\Category::all()->pluck('lake_guid')->all();

        foreach ($categories as $category) {

            $categoryId = $categoryIds[array_rand($categoryIds)];

            if ($categoryId != $category->getKey()) {
                $category->parent_id = $categoryId;
            }

        }

    }

}
