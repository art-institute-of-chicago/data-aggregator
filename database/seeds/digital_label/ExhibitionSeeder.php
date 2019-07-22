<?php

use App\Models\DigitalLabel\Exhibition;

class ExhibitionSeeder extends AbstractSeeder
{

    public function seed()
    {
        factory(App\Models\Collections\Exhibition::class, 10)->create();
        factory(Exhibition::class, 10)->create();
    }

}
