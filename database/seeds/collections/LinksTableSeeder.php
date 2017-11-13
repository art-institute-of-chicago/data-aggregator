<?php

use App\Models\Collections\Link;

class LinksTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( Link::class, 25 )->create();
    }

}
