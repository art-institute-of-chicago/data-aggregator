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

        $artworks = App\Models\Collections\Artwork::fake()->get();
        $categoryIds = App\Models\Collections\Category::fake()->pluck('citi_id')->all();

        foreach ($artworks as $artwork) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $artwork->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
