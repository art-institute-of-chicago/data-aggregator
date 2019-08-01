<?php

use App\Models\Archive\ArchiveImage;

class ArchiveImageSeeder extends AbstractSeeder
{

    public function seed()
    {
        factory(ArchiveImage::class, 10)->create();
    }

}
