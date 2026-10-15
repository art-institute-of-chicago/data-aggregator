<?php

namespace Database\Factories\Mobile;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class MobileFactory extends Factory
{
    public function mobileAppIdsAndTitle($title = ''): array
    {
        return [
            'id' => fake()->unique()->numberBetween(1, 10 ** 4 - 1),
            'title' => $title ? $title : ucfirst(fake()->words(3, true)),
        ];
    }
}
