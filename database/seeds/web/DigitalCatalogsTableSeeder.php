<?php

use App\Models\Web\DigitalCatalog;

class DigitalCatalogsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(DigitalCatalog::class, 25)->create();
    }

}
