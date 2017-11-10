<?php

use Illuminate\Database\Seeder;

class ArtworkTermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $artworks = App\Models\Collections\Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedTerms( $artwork );

        }

    }


    public function seedTerms( $artwork )
    {

        for ($i = 0; $i < rand(2,4); $i++) {

            $term = factory(App\Models\Collections\ArtworkTerm::class)->make([
                'artwork_citi_id' => $artwork->citi_id,
            ]);

            $artwork->terms()->save($term);

        }

    }


}
