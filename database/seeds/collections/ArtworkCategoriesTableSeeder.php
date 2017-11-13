<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\Category;

class ArtworkCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $artworks = Artwork::fake()->get();
        $categoryIds = Category::fake()->pluck('citi_id')->all();

        foreach ($artworks as $artwork) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $artwork->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
