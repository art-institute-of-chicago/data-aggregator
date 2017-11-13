<?php

use App\Models\Collections\Artwork;

class ArtworksTableSeeder extends AbstractSeeder
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
