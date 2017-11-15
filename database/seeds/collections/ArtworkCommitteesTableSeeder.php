<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkCommittee;

class ArtworkCommitteesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $artworks = Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedCommittees( $artwork );

        }

    }

    public function seedCommittees( $artwork )
    {

        factory( ArtworkCommittee::class, rand(2,4) )->create([
            'artwork_citi_id' => $artwork->getKey(),
        ]);

    }

}
