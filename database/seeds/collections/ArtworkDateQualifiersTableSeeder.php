<?php

use App\Models\Collections\ArtworkDateQualifer;

class ArtworkDateQualifersTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(ArtworkDateQualifer::class, 25)->create();
    }

}
