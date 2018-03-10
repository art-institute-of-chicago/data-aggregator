<?php

use App\Models\Web\Closure;

class ClosuresTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Closure::class, 25 )->create();

    }

}
