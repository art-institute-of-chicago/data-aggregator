<?php

use App\Models\Collections\Gallery;

class GalleriesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Gallery::class, 25 )->create();
    }
}
