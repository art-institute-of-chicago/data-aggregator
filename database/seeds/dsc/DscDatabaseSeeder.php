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

        $this->clean();

        $this->call(PublicationsTableSeeder::class);
        $this->call(TitlePagesTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(WorkOfArtsTableSeeder::class);
        $this->call(FootnotesTableSeeder::class);
        $this->call(FiguresTableSeeder::class);
        $this->call(CollectorsTableSeeder::class);

    }

    private function clean()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        App\Dsc\Publication::truncate();
        App\Dsc\TitlePage::truncate();
        App\Dsc\Section::truncate();
        App\Dsc\WorkOfArt::truncate();
        App\Dsc\Footnote::truncate();
        App\Dsc\Figure::truncate();
        App\Dsc\Collector::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

}