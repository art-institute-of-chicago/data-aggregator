<?php

use App\Models\Collections\Image;
use App\Models\Collections\Category;

class ImageCategoriesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $images = Image::fake();
        $categoryIds = Category::fake()->pluck('citi_id')->all();

        $images->each(function ($image, $key) use ($categoryIds) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $image->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        });

    }

}
