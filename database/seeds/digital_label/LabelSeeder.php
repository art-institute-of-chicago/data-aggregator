<?php

use App\Models\DigitalLabel\Label;
use App\Models\Collections\Artwork;
use App\Models\Collections\Agent;

class LabelSeeder extends AbstractSeeder
{

    public function seed()
    {

        factory( Artwork::class, 10 )->create();
        factory( Agent::class, 10 )->create();
        factory( Label::class, 10 )->create();

        $this->seedRelation( Label::class, Artwork::class, 'artworks' );
        $this->seedRelation( Label::class, Agent::class, 'artists' );

    }

}
