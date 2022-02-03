<?php

namespace Database\Factories\Collections;

use App\Models\Collections\AgentRole;

class AgentRoleFactory extends CollectionsFactory
{
    protected $model = AgentRole::class;

    public function definition()
    {
        return $this->idsAndTitle($this->faker->words(3, true), true, 2);
    }
}
