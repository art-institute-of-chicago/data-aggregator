<?php

use App\Models\Collections\Sound;
use App\Models\Collections\Category;

class SoundCategoriesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {

        $sounds = Sound::fake()->get();
        $categoryIds = Category::fake()->pluck('citi_id')->all();

        foreach ($sounds as $sound) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $sound->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
