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
        factory(App\Models\Collections\Category::class, 100)->create();

        $categories = App\Models\Collections\Category::all()->all();
        $categoryIds = App\Models\Collections\Category::all()->pluck('citi_id')->all();

        foreach ($categories as $category) {

            $categoryId = $categoryIds[array_rand($categoryIds)];

            if ($categoryId != $category->getKey()) {
                $category->parent_id = $categoryId;
            }

        }

    }

}
