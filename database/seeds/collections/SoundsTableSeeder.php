<?php

use App\Models\Collections\Sound;

class SoundsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( Sound::class, 25 )->create();
    }

}
