<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = env('PRIMO_API_SOURCE') . '999' . $this->faker->unique()->randomNumber(8);
        return [
            'id' => $id,
            'title' => ucfirst($this->faker->words(3, true)),
            'date' => $this->faker->year(),
        ];
    }
}
