<?php

namespace Database\Factories\Collections;

use App\Models\Collections\AgentRole;

class AgentRoleFactory extends CollectionsFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = AgentRole::class;

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
