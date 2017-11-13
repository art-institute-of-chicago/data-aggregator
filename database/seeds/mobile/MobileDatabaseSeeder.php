<?php

use App\Models\Mobile\Artwork;
use App\Models\Mobile\Sound;
use App\Models\Mobile\Tour;

class MobileDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(MobileArtworksTableSeeder::class);
        $this->call(MobileSoundsTableSeeder::class);
        $this->call(ToursTableSeeder::class);

    }

    protected static function unseed()
    {

        Artwork::fake()->delete();
        Sound::fake()->delete();
        Tour::fake()->delete();

    }

}
