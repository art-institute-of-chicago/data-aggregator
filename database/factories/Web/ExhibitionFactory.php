<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Web\Exhibition;

class ExhibitionFactory extends Factory
{
    protected $model = Exhibition::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4),
            'title' => ucfirst($this->faker->words(3, true)),
            'is_published' => true,
            'datahub_id' => $this->faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        ];
    }
}
