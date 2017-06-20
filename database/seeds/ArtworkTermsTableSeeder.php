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

        $faker = Faker\Factory::create();

        $artworks = App\Collections\Artwork::all()->all();

        foreach ($artworks as $artwork) {

            for ($i = 0; $i < rand(2,8); $i++) {
                
                $term = factory(App\Collections\ArtworkTerm::class)->make([
                    'artwork_citi_id' => $artwork->getAttribute($artwork->getKeyName()),
                ]);

                $artwork->terms()->save($term);

            }

        }
        
    }
    
}
