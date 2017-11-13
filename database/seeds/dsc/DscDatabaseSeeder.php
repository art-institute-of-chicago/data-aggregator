<?php

use App\Models\Dsc\Publication;
use App\Models\Dsc\Section;

class DscDatabaseSeeder extends AbstractSeeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(PublicationsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);

    }

    public static function clean()
    {

        Publication::fake()->delete();
        Section::fake()->delete();

    }

}
