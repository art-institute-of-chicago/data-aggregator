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
        $artistIds = App\Collections\Artist::all()->pluck('citi_id')->all();

        foreach ($artworks as $artwork) {

            for ($i = 0; $i < rand(2,8); $i++) {
                $artwork->artists()->attach($artistIds[array_rand($artistIds)]);
            }

        }
        
    }
    
}
