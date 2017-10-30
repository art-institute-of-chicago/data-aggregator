<?php

use Illuminate\Database\Seeder;

class StaticArchiveDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(SitesTableSeeder::class);

    }

    public static function clean()
    {

        App\Models\StaticArchive\Site::fake()->delete();

    }

}