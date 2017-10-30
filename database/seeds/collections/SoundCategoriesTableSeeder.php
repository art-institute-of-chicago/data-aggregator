<?php

use Illuminate\Database\Seeder;

class SoundCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sounds = App\Models\Collections\Sound::fake()->get();
        $categoryIds = App\Models\Collections\Category::fake()->pluck('citi_id')->all();

        foreach ($sounds as $sound) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $sound->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
