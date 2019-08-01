<?php

use App\Models\Dsc\Publication;

class PublicationsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(Publication::class, 25)->create();
    }

}
