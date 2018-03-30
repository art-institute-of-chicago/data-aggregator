<?php

use App\Models\Collections\ArtworkPlaceQualifierTableSeeder;

class ArtworkPlaceQualifierTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( ArtworkPlaceQualifierTableSeeder::class, 10 )->create();
    }

}
