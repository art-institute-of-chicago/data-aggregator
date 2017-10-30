<?php

use Illuminate\Database\Seeder;

class MobileArtworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Mobile\Artwork::class, 25)->create();
    }
}
