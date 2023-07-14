<?php

namespace Database\Factories\Mobile;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class MobileFactory extends Factory
{
    public function mobileAppIdsAndTitle($title = '')
    {
        return [
            'id' => fake()->unique()->randomNumber(4),
            'title' => $title ? $title : ucfirst(fake()->words(3, true)),
        ];
    }
}
