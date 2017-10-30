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

        $videos = App\Models\Collections\Video::fake()->get();
        $categoryIds = App\Models\Collections\Category::fake()->pluck('citi_id')->all();

        foreach ($videos as $video) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $video->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
