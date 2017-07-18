<?php

use Illuminate\Database\Seeder;

class ArtworkCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $artworks = App\Collections\Artwork::all()->all();
        $categoryIds = App\Collections\Category::all()->pluck('lake_guid')->all();

        foreach ($artworks as $artwork) {

            for ($i = 0; $i < rand(2,8); $i++) {
                $artwork->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
