<?php

use App\Models\Collections\Text;

class TextsTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( Text::class, 25 )->create();
    }
}
