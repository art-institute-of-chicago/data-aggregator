<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkCatalogue;

class ArtworkCataloguesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $artworks = Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedCatalogues( $artwork );

        }

    }

    public function seedCatalogues($artwork)
    {

        // There's a non-exclusive, many-to-many relationship b/w catalogues and artworks
        // A commitee can be (1) free-floating, and (2) assoc. w/ more than one artwork

        // We shouldn't receive catalogues that aren't assoc. w/ artworks

        $catalogues = factory( ArtworkCatalogue::class, rand(2, 4) )->create([
            'artwork_citi_id' => $artwork->getKey(),
            'preferred' => false,
        ]);

        $catalogue = $catalogues->random();
        $catalogue->preferred = true;
        $catalogue->save();

    }

}
