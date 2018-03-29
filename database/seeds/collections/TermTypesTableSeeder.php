<?php

use App\Models\Collections\TermType;

class TermTypesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( TermType::class, 5 )->create();
    }
}
