<?php

use App\Models\Web\Artist;

class ArtistsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Artist::class, 25 )->create();

    }

}
