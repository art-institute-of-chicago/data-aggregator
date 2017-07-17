<?php

use Illuminate\Database\Seeder;

class MobileDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->clean();

        $this->call(MobileArtworksTableSeeder::class);
        $this->call(MobileSoundsTableSeeder::class);
        $this->call(ToursTableSeeder::class);

    }

    private function clean()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        App\Mobile\Artwork::truncate();
        App\Mobile\Sound::truncate();
        App\Mobile\Tour::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

}