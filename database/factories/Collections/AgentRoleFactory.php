<?php

namespace Database\Factories\Collections;

class AgentRoleFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\AgentRole::class;

    public function definition()
    {
        return $this->idsAndTitle($this->faker->words(3, true), true, 2);
    }
}
