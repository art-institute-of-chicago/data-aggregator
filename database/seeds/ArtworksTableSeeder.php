<?php

use Illuminate\Database\Seeder;

class ArtworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Collections\Artwork::class, 100)->create();
    }
}
