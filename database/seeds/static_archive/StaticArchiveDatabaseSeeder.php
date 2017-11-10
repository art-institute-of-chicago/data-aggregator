<?php

use Illuminate\Database\Seeder;

use App\Models\StaticArchive\Site;

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

        Site::fake()->delete();

    }

}
