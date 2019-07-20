<?php

use App\Models\Web\Hour;

class HoursTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory(Hour::class, 25)->create();

    }

}
