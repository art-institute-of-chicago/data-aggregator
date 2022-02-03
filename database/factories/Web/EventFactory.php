<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = \App\Models\Web\Event::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4),
            'title' => ucfirst($this->faker->words(3, true)),
            'is_private' => false,
            'published' => true,
            'layout_type' => $this->faker->randomDigit,
        ];
    }
}
