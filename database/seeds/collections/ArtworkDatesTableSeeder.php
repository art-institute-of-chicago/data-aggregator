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

        $artworks = App\Models\Collections\Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedDates( $artwork );

        }

    }

    public function seedDates( $artwork )
    {

        $hasPreferred = false;

        for ($i = 0; $i < rand(2,4); $i++) {

            $preferred = $hasPreferred ? false : app('Faker')->boolean;

            $artwork->dates()->create([
                'date' => app('Faker')->dateTimeAD,
                'qualifier' => ucfirst( app('Faker')->word ) . ' date',
                'preferred' => $preferred,
            ]);

            if ($preferred || $hasPreferred) $hasPreferred = true;

        }

    }

}
