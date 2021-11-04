<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Web\Artist;

class ArtistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Artist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4) + 999 * pow(10, 4),
            'title' => ucfirst($this->faker->words(3, true)),
            'datahub_id' => $this->faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        ];
    }
}
