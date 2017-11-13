<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\Artist;

class ArtistArtworksTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {

        $artworks = Artwork::fake()->get();
        $artistsIds = Artist::fake()->pluck('citi_id')->all();

        foreach ($artworks as $artwork) {

            $ids = [];

            for ($i = 0; $i < rand(2,4); $i++) {

                $id = $artistsIds[array_rand($artistsIds)];

                if (!in_array($id, $ids)) {
                    $artwork->artists()->attach($id);
                    $ids[] = $id;
                }

            }

        }

    }

}
