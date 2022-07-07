<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class PrintedCatalogFactory extends Factory
{
    protected $model = \App\Models\Web\PrintedCatalog::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4),
            'title' => ucfirst($this->faker->words(3, true)),
            'is_published' => true,
        ];
    }
}
