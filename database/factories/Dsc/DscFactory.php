<?php

namespace Database\Factories\Dsc;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class DscFactory extends Factory
{
    public function dscIdsAndTitle($id = ''): array
    {
        return [
            'id' => $id ?: fake()->unique()->randomNumber(4),
            'title' => ucfirst(fake()->words(3, true)),
        ];
    }
}
