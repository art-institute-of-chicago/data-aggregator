<?php

use App\Models\Collections\Video;

class VideosTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( Video::class, 25 )->create();
    }

}
