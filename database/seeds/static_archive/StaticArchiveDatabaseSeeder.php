<?php

use App\Models\StaticArchive\Site;

class StaticArchiveDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {
        $this->call(SitesTableSeeder::class);
    }

    protected static function unseed()
    {
        Site::query()->delete();
    }

}
