<?php

use Illuminate\Database\Seeder;

class CollectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Dsc\Collector::class, 50)->create();
    }
}
