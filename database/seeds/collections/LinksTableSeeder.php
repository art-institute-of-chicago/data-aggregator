<?php

use App\Models\Collections\Link;

class LinksTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( Link::class, 25 )->create();
    }
}
