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

        // There's a non-exclusive, many-to-many relationship b/w committees and artworks
        // A commitee can be (1) free-floating, and (2) assoc. w/ more than one artwork

        // We shouldn't receive committees that aren't assoc. w/ artworks

        factory( ArtworkCommittee::class, rand(2,4) )->create([
            'artwork_citi_id' => $artwork->getKey(),
        ]);

    }

}
