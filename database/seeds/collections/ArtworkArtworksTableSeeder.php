<?php

use App\Models\Collections\Artwork;

class ArtworkArtworksTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedBelongsToMany( Artwork::class, Artwork::class, 'parts' );

    }

}
