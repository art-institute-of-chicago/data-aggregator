<?php

namespace Database\Factories\Mobile;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class MobileFactory extends Factory
{
    public function mobileAppIdsAndTitle($title = '')
    {
        return [
            'mobile_id' => $this->faker->unique()->randomNumber(4),
            'title' => $title ? $title : ucfirst($this->faker->words(3, true)),
        ];
    }
}
