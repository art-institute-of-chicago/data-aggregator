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
        factory(App\Models\Dsc\Footnote::class, 50)->create();
    }
}
