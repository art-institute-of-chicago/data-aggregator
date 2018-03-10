<?php

use App\Models\Web\Tag;
use App\Models\Web\Location;
use App\Models\Web\Hour;

class WebDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(TagsTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(HoursTableSeeder::class);

    }

    protected static function unseed()
    {

        Tag::fake()->delete();
        Location::fake()->delete();
        Hour::fake()->delete();

    }

}
