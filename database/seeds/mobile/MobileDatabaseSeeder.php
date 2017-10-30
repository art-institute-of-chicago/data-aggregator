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

        $this->call(MobileArtworksTableSeeder::class);
        $this->call(MobileSoundsTableSeeder::class);
        $this->call(ToursTableSeeder::class);

    }

    public static function clean()
    {

        App\Models\Mobile\Artwork::fake()->delete();
        App\Models\Mobile\Sound::fake()->delete();
        App\Models\Mobile\Tour::fake()->delete();

    }

}