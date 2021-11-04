<?php

namespace Database\Factories\Library;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Library\Material;

class MaterialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Material::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = env('PRIMO_API_SOURCE') . '999' . $this->faker->unique()->randomNumber(8);
        return [
            'id' => $id,
            'title' => ucfirst($this->faker->words(3, true)),
            'date' => $this->faker->year(),
        ];
    }
}
