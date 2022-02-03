<?php

namespace Database\Factories\Library;

use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    protected $model = \App\Models\Library\Material::class;

    public function definition()
    {
        $id = env('PRIMO_API_SOURCE') . $this->faker->unique()->randomNumber(8);
        return [
            'id' => $id,
            'title' => ucfirst($this->faker->words(3, true)),
            'date' => $this->faker->year(),
        ];
    }
}
