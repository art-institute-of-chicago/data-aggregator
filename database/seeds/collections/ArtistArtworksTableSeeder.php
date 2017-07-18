<?php

use Illuminate\Database\Seeder;

class ArtistArtworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $artworks = App\Collections\Artwork::all()->all();
        $artistsIds = App\Collections\Artist::all()->pluck('citi_id')->all();

        foreach ($artworks as $artwork) {

            $ids = [];

            for ($i = 0; $i < rand(2,8); $i++) {

                $id = $artistsIds[array_rand($artistsIds)];

                if (!in_array($id, $ids)) {
                    $artwork->artists()->attach($id);
                    $ids[] = $id;
                }

            }

        }

    }

}
