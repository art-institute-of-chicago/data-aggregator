<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkTerm;

class ArtworkTermsTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {

        $artworks = Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedTerms( $artwork );

        }

    }


    public function seedTerms( $artwork )
    {

        for ($i = 0; $i < rand(2,4); $i++) {

            $term = factory( ArtworkTerm::class )->make([
                'artwork_citi_id' => $artwork->citi_id,
            ]);

            $artwork->terms()->save($term);

        }

    }


}
