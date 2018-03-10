<?php

use App\Models\Web\Exhibition;

class ExhibitionsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Exhibition::class, 25 )->create();

    }

}
