<?php

use App\Models\Collections\Artwork;

class ArtworkArtworksTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedRelation( Artwork::class, Artwork::class, 'parts' );

    }

}
