<?php

use App\Models\Collections\Link;
use App\Models\Collections\Category;

class LinkCategoriesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {

        $links = Link::fake()->get();
        $categoryIds = Category::fake()->pluck('citi_id')->all();

        foreach ($links as $link) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $link->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
