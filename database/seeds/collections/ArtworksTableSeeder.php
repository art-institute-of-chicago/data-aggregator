<?php

use App\Models\Collections\Artwork;

class ArtworksTableSeeder extends AbstractSeeder
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
