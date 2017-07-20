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
        factory(App\Models\Dsc\TitlePage::class, 50)->create();
    }
}
