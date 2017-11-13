<?php

use App\Models\Collections\Category;

class CategoriesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory( Category::class, 25 )->create();

        $categories = Category::fake()->get();
        $categoryIds = Category::fake()->pluck('citi_id')->all();

        foreach ($categories as $category) {

            $categoryId = $categoryIds[array_rand($categoryIds)];

            if ($categoryId != $category->getKey()) {
                $category->parent_id = $categoryId;
            }

        }

    }

}
