<?php

use App\Models\Web\Tag;

class WebDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(TagsTableSeeder::class);

    }

    protected static function unseed()
    {

        Tag::fake()->delete();

    }

}
