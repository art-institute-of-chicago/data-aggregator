<?php

use App\Models\Web\Exhibition;

class WebExhibitionsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(Exhibition::class, 25)->create();
    }

}
