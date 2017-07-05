<?php

use Illuminate\Database\Seeder;

class FootnotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Dsc\Footnote::class, 200)->create();
    }
}
