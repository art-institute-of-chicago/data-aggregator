<?php

use App\Models\StaticArchive\Site;

class StaticArchiveDatabaseSeeder extends AbstractSeeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {

        $this->call(SitesTableSeeder::class);

    }

    protected static function unseed()
    {

        Site::fake()->delete();

    }

}
