<?php

namespace Database\Factories\StaticArchive;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    protected $model = \App\Models\StaticArchive\Site::class;

    public function definition(): array
    {
        return [
            'id' => fake()->unique()->numberBetween(1, 10 ** 4 - 1),
            'title' => ucfirst(fake()->words(3, true)),
            'description' => fake()->paragraph(5),
            'web_url' => fake()->url,
        ];
    }
}
