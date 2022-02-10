<?php

namespace Database\Factories\Dsc;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class DscFactory extends Factory
{

    public function dscIdsAndTitle($id = '')
    {
        return [
            'dsc_id' => $id ?: $this->faker->unique()->randomNumber(4),
            'title' => ucfirst($this->faker->words(3, true)),
        ];
    }
}
