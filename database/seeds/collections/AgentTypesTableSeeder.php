<?php

use App\Models\Collections\AgentType;

class AgentTypesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( AgentType::class, 10 )->create();
    }
}
