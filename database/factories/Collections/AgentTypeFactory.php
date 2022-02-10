<?php

namespace Database\Factories\Collections;

class AgentTypeFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\AgentType::class;

    public function definition()
    {
        return $this->idsAndTitle($this->faker->unique()->randomElement(['Individual', 'Corporate Body', $this->faker->words(2, true)]), true, 2);
    }
}
