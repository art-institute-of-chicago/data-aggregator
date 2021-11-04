<?php

namespace Database\Factories;

class AgentRoleFactory extends CollectionsFactory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return $this->idsAndTitle($this->faker->words(3, true), true, 2);
    }
}
