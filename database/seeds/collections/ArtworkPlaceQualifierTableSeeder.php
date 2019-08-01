<?php

use App\Models\Collections\ArtworkPlaceQualifier;

class ArtworkPlaceQualifierTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(ArtworkPlaceQualifier::class, 10)->create();
    }

}
