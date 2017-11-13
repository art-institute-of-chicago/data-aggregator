<?php

use App\Models\Mobile\Artwork;
use App\Models\Mobile\Sound;
use App\Models\Mobile\Tour;

class MobileDatabaseSeeder extends AbstractSeeder
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

        Artwork::fake()->delete();
        Sound::fake()->delete();
        Tour::fake()->delete();

    }

}
