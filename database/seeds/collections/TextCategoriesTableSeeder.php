<?php

use App\Models\Collections\Text;
use App\Models\Collections\Category;

class TextCategoriesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {

        $texts = Text::fake()->get();
        $categoryIds = Category::fake()->pluck('citi_id')->all();

        foreach ($texts as $text) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $text->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
