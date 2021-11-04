<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DigitalCatalogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4) + 999 * pow(10, 4),
            'title' => ucfirst($this->faker->words(3, true)),
            'published' => true,
        ];
    }
}
