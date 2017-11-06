<?php

use Illuminate\Database\Seeder;

class DscDatabaseSeeder extends Seeder
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
        $this->call(WorkOfArtsTableSeeder::class);

    }

    public static function clean()
    {

        App\Models\Dsc\Publication::fake()->delete();
        App\Models\Dsc\Section::fake()->delete();
        App\Models\Dsc\WorkOfArt::fake()->delete();

    }

}
