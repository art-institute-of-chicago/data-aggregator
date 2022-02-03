<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class PressReleaseFactory extends Factory
{
    protected $model = \App\Models\Web\PressRelease::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4) + 999 * pow(10, 4),
            'title' => ucfirst($this->faker->words(3, true)),
            'published' => true,
        ];
    }
}
