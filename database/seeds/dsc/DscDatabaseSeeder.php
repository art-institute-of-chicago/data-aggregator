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
        $this->call(TitlePagesTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(WorkOfArtsTableSeeder::class);
        $this->call(FiguresTableSeeder::class);
        $this->call(CollectorsTableSeeder::class);

    }

    public static function clean()
    {

        App\Models\Dsc\Publication::fake()->delete();
        App\Models\Dsc\TitlePage::fake()->delete();
        App\Models\Dsc\Section::fake()->delete();
        App\Models\Dsc\WorkOfArt::fake()->delete();
        App\Models\Dsc\Figure::fake()->delete();
        App\Models\Dsc\Collector::fake()->delete();

    }

}
