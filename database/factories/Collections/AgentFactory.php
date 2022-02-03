<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Agent;
use App\Models\Collections\AgentType;

class AgentFactory extends CollectionsFactory
{
    protected $model = Agent::class;

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
                'birth_place' => $this->faker->country,
                'death_place' => $this->faker->country,
                'licensing_restricted' => $this->faker->boolean,
                'agent_type_citi_id' => $this->faker->randomElement(AgentType::query()->pluck('citi_id')->all()),
            ],
            $this->dates(true)
        );
    }
}
