<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
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
                
                $image = factory(App\Collections\Image::class)->make([
                    'artwork_citi_id' => $artwork->getAttribute($artwork->getKeyName()),
                    'preferred' => $preferred,
                ]);

                $artwork->images()->save($image);

                if ($preferred || $hasPreferred) $hasPreferred = true;

            }

        }

    }

}
