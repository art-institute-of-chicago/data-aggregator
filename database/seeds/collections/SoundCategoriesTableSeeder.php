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

        $sounds = App\Collections\Sound::all()->all();
        $categoryIds = App\Collections\Category::all()->pluck('lake_guid')->all();

        foreach ($sounds as $sound) {

            for ($i = 0; $i < rand(2,8); $i++) {
                $sound->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
