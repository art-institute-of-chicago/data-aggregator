<?php

use App\Models\Dsc\Section;

class SectionsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(Section::class, 50)->create();
    }

}
