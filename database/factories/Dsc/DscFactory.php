<?php

namespace Database\Factories\Dsc;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class DscFactory extends Factory
{
    public function dscIdsAndTitle($id = ''): array
    {
        return [
            'id' => $id ?: fake()->unique()->numberBetween(1, 10 ** 4 - 1),
            'title' => ucfirst(fake()->words(3, true)),
        ];
    }
}
