<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\Agent;

class ArtistArtworksTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedRelation(Artwork::class, Agent::class, 'artists');

    }

}
