<?php

use Illuminate\Database\Seeder;

class ArtworkCommitteesTableSeeder extends Seeder
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
                
                $committee = factory(App\Collections\ArtworkCommittee::class)->make([
                    'artwork_citi_id' => $artwork->getAttribute($artwork->getKeyName()),
                ]);

                $artwork->committees()->save($committee);

            }

        }
        
    }
    
}
