<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Video;
use App\Models\Collections\Category;

class VideoCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $videos = Video::fake()->get();
        $categoryIds = Category::fake()->pluck('citi_id')->all();

        foreach ($videos as $video) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $video->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
