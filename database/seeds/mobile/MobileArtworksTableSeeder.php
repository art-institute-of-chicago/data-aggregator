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
        factory(App\Mobile\Artwork::class, 100)->create();
    }
}
