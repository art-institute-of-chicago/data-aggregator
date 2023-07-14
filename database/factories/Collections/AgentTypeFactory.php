<?php

namespace Database\Factories\Collections;

class AgentTypeFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\AgentType::class;

    public function definition()
    {
        return $this->idsAndTitle(fake()->unique()->randomElement(['Individual', 'Corporate Body', fake()->words(2, true)]), true, 2);
    }
}
