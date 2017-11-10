<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Artwork;

class ArtworkCataloguesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $artworks = Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedCatalogues( $artwork );

        }

    }

    public function seedCatalogues( $artwork )
    {

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
