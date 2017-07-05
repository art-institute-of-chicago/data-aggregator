<?php

use Illuminate\Database\Seeder;

class WorkOfArtsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Dsc\WorkOfArt::class, 300)->create();
    }
}
