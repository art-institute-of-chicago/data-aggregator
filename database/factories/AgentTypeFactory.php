<?php

namespace Database\Factories;

class AgentTypeFactory extends CollectionsFactory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return $this->idsAndTitle($this->faker->unique()->randomElement(['Individual', 'Corporate Body', $this->faker->words(2, true)]), true, 2);
    }
}
