<?php

use App\Models\Collections\Agent;

class AgentsTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Agent::class, 100 )->create();
    }

}
