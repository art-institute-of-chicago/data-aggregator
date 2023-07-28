<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventProgramFactory extends Factory
{
    protected $model = \App\Models\Web\EventProgram::class;

    public function definition()
    {
        return [
            'id' => fake()->unique()->randomNumber(4),
            'title' => ucfirst(fake()->words(3, true)),
        ];
    }
}
