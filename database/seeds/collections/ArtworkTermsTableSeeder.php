<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkTerm;

class ArtworkTermsTableSeeder extends AbstractSeeder
{

    public function seedTerms($artwork)
    {

        factory(ArtworkTerm::class, rand(2, 4))->create([
            'artwork_citi_id' => $artwork->getKey(),
        ]);

    }

    protected function seed()
    {

        $artworks = Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedTerms($artwork);

        }

    }

}
