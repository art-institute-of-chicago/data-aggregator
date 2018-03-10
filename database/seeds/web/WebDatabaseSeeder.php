<?php

use App\Models\Web\Tag;
use App\Models\Web\Location;
use App\Models\Web\Hour;
use App\Models\Web\Closure;

class WebDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(TagsTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(HoursTableSeeder::class);
        $this->call(ClosuresTableSeeder::class);

    }

    protected static function unseed()
    {

        Tag::fake()->delete();
        Location::fake()->delete();
        Hour::fake()->delete();
        Closure::fake()->delete();

    }

}
