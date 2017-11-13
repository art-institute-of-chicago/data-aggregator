<?php

use App\Models\Collections\Artwork;

class ArtworkArtworksTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $artworks = Artwork::fake();
        $artworkIds = Artwork::fake()->pluck('citi_id')->all();

        $artworks->each(function($artwork, $key) use ($artworkIds) {

            for ($i = 0; $i < rand(2,4); $i++) {

                $artworkId = $artworkIds[array_rand($artworkIds)];

                if ($artworkId != $artwork->getKey()) {
                    $artwork->parts()->attach($artworkId);
                }

            }

        });

    }

}
