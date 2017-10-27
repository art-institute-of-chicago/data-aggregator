<?php

use Illuminate\Database\Seeder;

class TextCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $texts = App\Models\Collections\Text::fake()->get();
        $categoryIds = App\Models\Collections\Category::fake()->pluck('citi_id')->all();

        foreach ($texts as $text) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $text->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
