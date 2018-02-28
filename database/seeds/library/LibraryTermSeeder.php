<?php

use App\Models\Library\Term;

class LibraryTermSeeder extends AbstractSeeder
{

    public function seed()
    {

        factory( Term::class, 10 )->create();

    }

}
