<?php

use App\Models\Collections\Gallery;

class GalleriesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( Gallery::class, 25 )->create();
    }
}
