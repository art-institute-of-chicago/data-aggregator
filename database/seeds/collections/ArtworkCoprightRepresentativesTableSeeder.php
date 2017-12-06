<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\Agent;

class ArtworkCopyrightRepresentativesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedRelation( Artwork::class, Agent::class, 'copyrightRepresentatives' );

    }

}
