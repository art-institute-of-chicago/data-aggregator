<?php

use App\Models\Collections\Agent;

class AgentsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( Agent::class, 100 )->create();
    }

}
