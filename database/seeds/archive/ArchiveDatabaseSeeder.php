<?php

use App\Models\Archive\ArchiveImage;

class ArchiveDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {
        $this->call(ArchiveImageSeeder::class);
    }

    protected static function unseed()
    {
        ArchiveImage::fake()->delete();
    }

}
