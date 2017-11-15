<?php

use App\Models\Collections\Artwork;

class ArtworkCataloguesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $artworks = Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedCatalogues( $artwork );

        }

    }

    public function seedCatalogues( $artwork )
    {

        // There's a non-exclusive, many-to-many relationship b/w catalogues and artworks
        // A commitee can be (1) free-floating, and (2) assoc. w/ more than one artwork

        // We shouldn't receive catalogues that aren't assoc. w/ artworks

        $hasPreferred = false;

        for ($i = 0; $i < rand(2,4); $i++) {

            $preferred = app('Faker')->boolean;

            $artwork->catalogues()->create([
                'preferred' => $hasPreferred ? false : app('Faker')->boolean,
                'catalogue' => ucwords( app('Faker')->words(2, true) ),
                'number' => app('Faker')->randomNumber(3),
                'state_edition' => app('Faker')->words(2, true),
            ]);

            if ($preferred || $hasPreferred) $hasPreferred = true;

        }

        return $this;

    }

}
