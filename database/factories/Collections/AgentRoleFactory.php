<?php

namespace Database\Factories\Collections;

class AgentRoleFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\AgentRole::class;

    public function definition(): array
    {
        return $this->idsAndTitle(fake()->words(3, true), true, 2);
    }
}
