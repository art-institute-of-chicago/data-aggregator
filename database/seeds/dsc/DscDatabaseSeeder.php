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

        App\Models\Dsc\Publication::truncate();
        App\Models\Dsc\TitlePage::truncate();
        App\Models\Dsc\Section::truncate();
        App\Models\Dsc\WorkOfArt::truncate();
        App\Models\Dsc\Footnote::truncate();
        App\Models\Dsc\Figure::truncate();
        App\Models\Dsc\Collector::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

}