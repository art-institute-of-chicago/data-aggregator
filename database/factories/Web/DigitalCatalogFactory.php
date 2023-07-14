<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class DigitalCatalogFactory extends Factory
{
    protected $model = \App\Models\Web\DigitalCatalog::class;

    public function definition()
    {
        return [
            'id' => fake()->unique()->randomNumber(4),
            'title' => ucfirst(fake()->words(3, true)),
        ];
    }
}
