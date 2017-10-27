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

        $artworks = App\Models\Collections\Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $artwork->seedTerms();

        }

    }

}
