<?php

use App\Models\Collections\AgentType;

class AgentTypesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(AgentType::class, 10)->create();
    }
}
