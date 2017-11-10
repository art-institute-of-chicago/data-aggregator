<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Artwork;

class ArtworksTableSeeder extends Seeder
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
