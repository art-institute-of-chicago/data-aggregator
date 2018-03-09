<?php

use App\Models\Web\Location;

class LocationsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Location::class, 25 )->create();

    }

}
