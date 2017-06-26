<?php

use Illuminate\Database\Seeder;

class ArtworkCataloguesTableSeeder extends Seeder
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

            $hasPreferred = false;
            
            for ($i = 0; $i < rand(2,8); $i++) {
                
                $preferred = $faker->boolean;
                
                $artwork->catalogues()->create([
                    'preferred' => $hasPreferred ? false : $faker->boolean,
                    'catalogue' => ucwords($faker->words(2, true)),
                    'number' => $faker->randomNumber(3),
                    'state_edition' => $faker->words(2, true),
                ]);

                if ($preferred || $hasPreferred) $hasPreferred = true;

            }

        }
        
    }
    
}
