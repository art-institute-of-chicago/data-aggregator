<?php

use App\Models\Collections\Link;

class LinksTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Link::class, 25 )->create();
    }
}
