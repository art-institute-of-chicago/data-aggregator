<?php

use App\Models\Collections\Term;

class TermsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(Term::class, 25)->create();
    }
}
