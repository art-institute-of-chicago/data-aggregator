<?php

use App\Models\Mobile\Artwork;

class MobileArtworksTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(Artwork::class, 25)->create();
    }

}
