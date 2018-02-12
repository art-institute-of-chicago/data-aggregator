<?php

use App\Models\Collections\ArtworkType;

class ArtworkTypesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( ArtworkType::class, 25 )->create();
    }

}
