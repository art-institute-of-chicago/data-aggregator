<?php

use App\Models\Collections\ArtworkDateQualifier;

class ArtworkDateQualifiersTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(ArtworkDateQualifier::class, 25)->create();
    }

}
