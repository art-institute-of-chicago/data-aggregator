<?php

namespace Database\Factories\Collections;

use App\Models\Collections\AgentType;

class AgentFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Agent::class;

    public function definition(): array
    {
        $first_name = fake()->firstName;
        $last_name = fake()->lastName;

        return array_merge(
            $this->idsAndTitle(ucwords($first_name . ' ' . $last_name), true, 6),
            [
                'sort_title' => $last_name . ', ' . $first_name,
                'alt_titles' => [],
                'birth_date' => fake()->year,
                'death_date' => fake()->year,
                'agent_type_id' => fake()->randomElement(AgentType::query()->pluck('id')->all()),
            ],
            $this->dates(true)
        );
    }
}
