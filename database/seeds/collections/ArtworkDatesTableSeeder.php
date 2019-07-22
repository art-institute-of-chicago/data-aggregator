<?php

use App\Models\Collections\Artwork;

class ArtworkDatesTableSeeder extends AbstractSeeder
{

    public function seedDates($artwork)
    {
        $hasPreferred = false;

        // There's an exclusive, many-to-one relationship b/w dates and artworks
        // A date cannot be (1) free-floating, or (2) assoc. w/ more than one artwork

        for ($i = 0; $i < rand(2, 4); $i++) {

            $preferred = $hasPreferred ? false : app('Faker')->boolean;

            // TODO: Determine if this runs the risk of "duplicating" dates
            $artwork->dates()->create([
                'date_earliest' => app('Faker')->dateTimeAD,
                'date_latest' => app('Faker')->dateTimeAD,
                'qualifier' => ucfirst(app('Faker')->word) . ' date',
                'preferred' => $preferred,
            ]);

            if ($preferred || $hasPreferred) $hasPreferred = true;

        }
    }

    protected function seed()
    {
        $artworks = Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedDates($artwork);

        }
    }

}
