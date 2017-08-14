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

        $texts = App\Models\Collections\Text::all()->all();
        $categoryIds = App\Models\Collections\Category::all()->pluck('citi_id')->all();

        foreach ($texts as $text) {

            for ($i = 0; $i < rand(2,8); $i++) {
                $text->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
