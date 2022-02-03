<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventProgramFactory extends Factory
{
    protected $model = \App\Models\Web\EventProgram::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4) + 999 * pow(10, 4),
            'title' => ucfirst($this->faker->words(3, true)),
        ];
    }
}
