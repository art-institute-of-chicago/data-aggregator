<?php

use App\Models\Dsc\Publication;
use App\Models\Dsc\Section;

class DscDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {
        $this->call(PublicationsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
    }

    protected static function unseed()
    {
        Publication::fake()->delete();
        Section::fake()->delete();
    }

}
