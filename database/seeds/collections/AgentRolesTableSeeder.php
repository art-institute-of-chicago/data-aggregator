<?php

use App\Models\Collections\AgentRole;

class AgentRolesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(AgentRole::class, 10)->create();
    }

}
