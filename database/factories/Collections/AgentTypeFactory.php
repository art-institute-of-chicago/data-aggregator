<?php

namespace Database\Factories\Collections;

use App\Models\Collections\AgentType;

class AgentTypeFactory extends CollectionsFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = AgentType::class;

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
