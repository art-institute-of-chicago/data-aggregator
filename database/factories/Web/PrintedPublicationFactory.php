<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class PrintedPublicationFactory extends Factory
{
    protected $model = \App\Models\Web\PrintedPublication::class;

    public function definition(): array
    {
        return [
            'id' => fake()->unique()->numberBetween(1, 10 ** 4 - 1),
            'title' => ucfirst(fake()->words(3, true)),
        ];
    }
}
