<?php

namespace Database\Factories\Web;

use App\Models\Web\Exhibition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExhibitionFactory extends Factory
{
    protected $model = Exhibition::class;

    public function definition(): array
    {
        return [
            'id' => fake()->unique()->randomNumber(4),
            'title' => ucfirst(fake()->words(3, true)),
            'datahub_id' => fake()->unique()->randomNumber(4),
        ];
    }

    public function withNocacheUrl(): static
    {
        return $this->state(fn() => [])
            ->afterMaking(function (Exhibition $exhibition) {
                $exhibition->web_url =
                    "https://nocache.www.artic.edu/exhibitions/{$exhibition->id}/" . Str::slug($exhibition->title);
            });
    }
}
