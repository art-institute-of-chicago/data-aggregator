<?php

use App\Models\Collections\Place;

class PlacesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(Place::class, 25)->create();
    }

}
