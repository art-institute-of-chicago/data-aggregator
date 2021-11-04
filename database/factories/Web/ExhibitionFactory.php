<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Web\Exhibition;

class ExhibitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Exhibition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
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
