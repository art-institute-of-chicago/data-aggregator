<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Artwork;
use App\Models\Collections\Category;

class ArtworkCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
