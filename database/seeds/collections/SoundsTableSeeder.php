<?php

use App\Models\Collections\Sound;

class SoundsTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Sound::class, 25 )->create();
    }
}
