<?php

use Illuminate\Database\Seeder;

use App\Models\Mobile\Artwork;

class MobileArtworksTableSeeder extends Seeder
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
