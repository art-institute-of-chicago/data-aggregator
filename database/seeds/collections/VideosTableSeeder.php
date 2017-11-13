<?php

use App\Models\Collections\Video;

class VideosTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Video::class, 25 )->create();
    }
}
