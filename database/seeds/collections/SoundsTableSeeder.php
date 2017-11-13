<?php

use App\Models\Collections\Sound;

class SoundsTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( Sound::class, 25 )->create();
    }
}
