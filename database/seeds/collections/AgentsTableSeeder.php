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

}
