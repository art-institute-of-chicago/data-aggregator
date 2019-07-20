<?php

use App\Models\Collections\Asset;
use App\Models\Collections\Artwork;

class AssetsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $key = ( new Asset() )->getKeyName();

        $images = factory( Asset::class, 50 )->states('image')->create();
        $texts = factory( Asset::class, 25 )->states('text')->create();
        $sounds = factory( Asset::class, 25 )->states('sound')->create();
        $videos = factory( Asset::class, 25 )->states('video')->create();

        $artworks = Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $alternate = $images->random( rand( 1, 3 ) );

            $preferred = $images->diff( $alternate )->random();

            $artwork->images()->sync( [
                $preferred->getKey() => [
                    'preferred' => true
                ]
            ]);

            $artwork->images()->sync( $alternate, false );

        }

    }

}
