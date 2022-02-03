<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    protected $model = \App\Models\Web\Artist::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4),
            'title' => ucfirst($this->faker->words(3, true)),
            'datahub_id' => $this->faker->unique()->randomNumber(4),
        ];
    }
}
