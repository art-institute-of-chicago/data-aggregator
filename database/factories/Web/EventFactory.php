<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = \App\Models\Web\Event::class;

    public function definition(): array
    {
        return [
            'id' => fake()->unique()->numberBetween(1, 10 ** 4 - 1),
            'title' => ucfirst(fake()->words(3, true)),
            'is_private' => false,
            'layout_type' => fake()->randomDigit,
        ];
    }
}
