<?php

use App\Models\Mobile\Sound;
use App\Models\Mobile\Artwork;

class MobileSoundsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Sound::class, 25 )->create();

        $this->seedPivot( Artwork::class, Sound::class, 'sounds' );

    }

}
