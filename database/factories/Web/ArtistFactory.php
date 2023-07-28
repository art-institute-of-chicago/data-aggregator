<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    protected $model = \App\Models\Web\Artist::class;

    public function definition()
    {
        return [
            'id' => fake()->unique()->randomNumber(4),
            'agent_id' => fake()->unique()->randomNumber(4),
        ];
    }
}
