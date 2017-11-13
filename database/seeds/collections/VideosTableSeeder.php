<?php

use App\Models\Collections\Video;

class VideosTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( Video::class, 25 )->create();
    }
}
