<?php

use App\Models\Archive\ArchivalImage;

class ArchiveDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(ArchivalImageSeeder::class);

    }

    protected static function unseed()
    {

        ArchivalImage::fake()->delete();

    }

}
