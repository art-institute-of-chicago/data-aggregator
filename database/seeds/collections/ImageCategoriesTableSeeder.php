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

        $images = App\Collections\Image::all()->all();
        $categoryIds = App\Collections\Category::all()->pluck('citi_id')->all();

        foreach ($images as $image) {

            for ($i = 0; $i < rand(2,8); $i++) {
                $image->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
