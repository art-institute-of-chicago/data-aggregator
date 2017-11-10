<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Gallery;
use App\Models\Collections\Category;

class GalleryCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $galleries = Gallery::fake()->get();
        $categoryIds = Category::fake()->pluck('citi_id')->all();

        foreach ($galleries as $gallery) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $gallery->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
