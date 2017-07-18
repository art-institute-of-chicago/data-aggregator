<?php

use Illuminate\Database\Seeder;

class GalleryCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $galleries = App\Collections\Gallery::all()->all();
        $categoryIds = App\Collections\Category::all()->pluck('lake_guid')->all();

        foreach ($galleries as $gallery) {

            for ($i = 0; $i < rand(2,8); $i++) {
                $gallery->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
