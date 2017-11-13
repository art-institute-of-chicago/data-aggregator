<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkDate;

class ArtworkDatesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {

        $artworks = Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedDates( $artwork );

        }

    }

    public function seedDates( $artwork )
    {

        $hasPreferred = false;

        for ($i = 0; $i < rand(2,4); $i++) {

            $preferred = $hasPreferred ? false : app('Faker')->boolean;

            // TODO: Determine if this runs the risk of "duplicating" dates
            $artwork->dates()->create([
                'date' => app('Faker')->dateTimeAD,
                'qualifier' => ucfirst( app('Faker')->word ) . ' date',
                'preferred' => $preferred,
            ]);

            if ($preferred || $hasPreferred) $hasPreferred = true;

        }

    }

}
