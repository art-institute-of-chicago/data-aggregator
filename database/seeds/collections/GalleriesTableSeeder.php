<?php

use App\Models\Collections\Gallery;

class GalleriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( Gallery::class, 25 )->create();
    }

}
