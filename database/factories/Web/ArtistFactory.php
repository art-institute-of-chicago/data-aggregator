<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    protected $model = \App\Models\Web\Artist::class;

    public function definition(): array
    {
        return [
            'id' => fake()->unique()->numberBetween(1, 10 ** 4 - 1),
            'agent_id' => fake()->unique()->numberBetween(1, 10 ** 4 - 1),
        ];
    }
}
