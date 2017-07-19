<?php

use Illuminate\Database\Seeder;

class ArtworkArtworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $artworks = App\Collections\Artwork::all();
        $artworkIds = App\Collections\Artwork::all()->pluck('citi_id')->all();

        $artworks->each(function($artwork, $key) {

            for ($i = 0; $i < rand(2,4); $i++) {

                $artworkId = $artworkIds[array_rand($artworkIds)];

                if ($artworkId != $artwork->getKey()) {
                    $artwork->parts()->attach($artworkId);
                }

            }

        });

    }

}
