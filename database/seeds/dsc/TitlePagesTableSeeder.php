<?php

use Illuminate\Database\Seeder;

class TitlePagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Dsc\TitlePage::class, 50)->create();
    }
}
