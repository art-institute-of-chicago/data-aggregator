<?php

use App\Models\Mobile\Artwork;

class MobileArtworksTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Artwork::class, 25 )->create();
    }
}
