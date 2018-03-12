<?php

use App\Models\Web\Selection;

class SelectionsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Selection::class, 25 )->create();

    }

}
