<?php

use App\Models\Collections\Image;
use App\Models\Collections\Artwork;

class ImagesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Image::class, 100 )->create();

        $this->seedRelation( Artwork::class, Image::class, 'images' );

        $this->seedPreferred();

    }

    private function seedPreferred()
    {

        $artworks = Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $image = $artwork->images->random();

            $artwork->images()->updateExistingPivot( $image->getKey(), [ 'preferred' => true ] );

        }

    }

}
