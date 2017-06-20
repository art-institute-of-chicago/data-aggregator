<?php

use Illuminate\Database\Seeder;

class ArtworkDatesTableSeeder extends Seeder
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
                
                $preferred = $hasPreferred ? false : $faker->boolean;
                
                $artwork->dates()->create([
                    'date' => $faker->dateTimeAD,
                    'qualifier' => ucfirst($faker->word) .' date',
                    'preferred' => $preferred,
                ]);

                if ($preferred || $hasPreferred) $hasPreferred = true;

            }

        }
        
    }
    
}
