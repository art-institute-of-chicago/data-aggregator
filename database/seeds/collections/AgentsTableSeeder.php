<?php

use App\Models\Collections\Agent;

class AgentsTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( Agent::class, 100 )->create();
    }

}
