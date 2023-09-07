<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class PrintedCatalogFactory extends Factory
{
    protected $model = \App\Models\Web\PrintedCatalog::class;

    public function definition(): array
    {
        return [
            'id' => fake()->unique()->randomNumber(4),
            'title' => ucfirst(fake()->words(3, true)),
        ];
    }
}
