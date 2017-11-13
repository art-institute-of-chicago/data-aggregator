<?php

use App\Models\Collections\Artwork;

class ArtworkArtworksTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedPivot( Artwork::class, Artwork::class, 'parts' );

    }

}
