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
        factory(App\Models\Dsc\WorkOfArt::class, 25)->create();
    }
}
