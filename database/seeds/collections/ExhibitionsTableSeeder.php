<?php

use App\Models\Collections\Exhibition;
use App\Models\Collections\Artwork;
use App\Models\Collections\Agent;

class ExhibitionsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Exhibition::class, 25 )->create();

        $this->seedRelation( Exhibition::class, Artwork::class, 'artworks' );

        $this->seedRelation( Exhibition::class, AgentExhibition::class, 'venues' );

    }

}
