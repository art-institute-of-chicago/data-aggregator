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

        $this->clean();

        $this->call(SitesTableSeeder::class);

    }

    private function clean()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        App\StaticArchive\Site::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

}