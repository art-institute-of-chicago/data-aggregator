<?php

use Illuminate\Database\Seeder;

class ArtworkGalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $artworks = App\Collections\Artwork::all()->all();
        $galleryIds = App\Collections\Gallery::all()->pluck('citi_id')->all();

        foreach ($artworks as $artwork) {

            for ($i = 0; $i < rand(2,8); $i++) {
                $artwork->galleries()->attach($galleryIds[array_rand($galleryIds)]);
            }

        }
        
    }
    
}
