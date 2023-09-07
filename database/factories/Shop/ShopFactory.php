<?php

namespace Database\Factories\Shop;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class ShopFactory extends Factory
{
    public function shopIdsAndTitle($title = ''): array
    {
        return [
            'id' => fake()->unique()->randomNumber(3),
            'title' => $title ? $title : ucfirst(fake()->words(5, true)),
        ];
    }

    public function shopDates(): array
    {
        return [
            'source_updated_at' => fake()->dateTimeThisYear,
        ];
    }
}
