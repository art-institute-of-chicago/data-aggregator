<?php

use App\Models\Collections\Artwork;

class ArtworksTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( Artwork::class, 25 )->create();
    }
}
