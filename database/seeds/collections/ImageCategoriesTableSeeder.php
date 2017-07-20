<?php

use Illuminate\Database\Seeder;

class ImageCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $images = App\Models\Collections\Image::all();
        $categoryIds = App\Models\Collections\Category::all()->pluck('citi_id')->all();

        $images->each(function ($image, $key) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $image->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        });

    }

}
