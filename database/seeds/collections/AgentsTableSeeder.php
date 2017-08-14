<?php

use Illuminate\Database\Seeder;
use App\Models\Collections\Agent;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Agent::class, 100)->create();
    }

    public function clean()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Agent::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

}
