<?php

use App\Models\Mobile\Artwork;

class MobileArtworksTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( Artwork::class, 25 )->create();
    }
}
