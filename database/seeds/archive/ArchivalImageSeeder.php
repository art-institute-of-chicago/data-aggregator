<?php

use App\Models\Archive\ArchivalImage;

class ArchivalImageSeeder extends AbstractSeeder
{

    public function seed()
    {

        factory( ArchivalImage::class, 10 )->create();

    }

}
