<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DscFactory extends Factory
{

    public function dscIdsAndTitle($id = '')
    {
        return [
            'dsc_id' => $id ?: $this->faker->unique()->randomNumber(4) + 999 * pow(10, 4),
            'title' => ucfirst($this->faker->words(3, true)),
        ];
    }
}
