<?php

use Illuminate\Database\Seeder;

class VideoCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $videos = App\Collections\Video::all()->all();
        $categoryIds = App\Collections\Category::all()->pluck('lake_guid')->all();

        foreach ($videos as $video) {

            for ($i = 0; $i < rand(2,8); $i++) {
                $video->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
