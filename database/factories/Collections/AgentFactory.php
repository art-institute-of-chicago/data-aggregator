<?php

namespace Database\Factories\Collections;

use App\Models\Collections\AgentType;

class AgentFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Agent::class;

    public function definition()
    {
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;

        return array_merge(
            $this->idsAndTitle(ucwords($first_name . ' ' . $last_name), true, 6),
            [
                'sort_title' => $last_name . ', ' . $first_name,
                'alt_titles' => [],
                'birth_date' => $this->faker->year,
                'death_date' => $this->faker->year,
                'agent_type_id' => $this->faker->randomElement(AgentType::query()->pluck('id')->all()),
            ],
            $this->dates(true)
        );
    }
}
