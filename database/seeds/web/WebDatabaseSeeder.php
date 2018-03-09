<?php

use App\Models\Web\Tag;
use App\Models\Web\Location;

class WebDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(TagsTableSeeder::class);
        $this->call(LocationsTableSeeder::class);

    }

    protected static function unseed()
    {

        Tag::fake()->delete();
        Location::fake()->delete();

    }

}
