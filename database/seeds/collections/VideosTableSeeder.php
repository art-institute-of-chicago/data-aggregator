<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Video;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Video::class, 25 )->create();
    }
}
