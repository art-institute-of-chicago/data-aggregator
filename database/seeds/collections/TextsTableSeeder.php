<?php

use App\Models\Collections\Text;

class TextsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( Text::class, 25 )->create();
    }

}
