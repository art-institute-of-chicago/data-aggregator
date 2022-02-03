<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Web\Closure;

class ClosureFactory extends Factory
{
    protected $model = Closure::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4) + 999 * pow(10, 4),
            'title' => ucfirst($this->faker->words(3, true)),
            'date_start' => $this->faker->date(),
            'date_end' => $this->faker->date(),
            'type' => $this->faker->randomDigit,
        ];
    }
}
