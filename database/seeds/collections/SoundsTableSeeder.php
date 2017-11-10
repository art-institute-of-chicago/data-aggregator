<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Sound;

class SoundsTableSeeder extends Seeder
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
