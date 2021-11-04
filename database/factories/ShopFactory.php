<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShopFactory extends Factory
{
    public function shopIdsAndTitle($title = '')
    {
        return [
            'shop_id' => $this->faker->unique()->randomNumber(3) + 999 * pow(10, 3),
            'title' => $title ? $title : ucfirst($this->faker->words(5, true)),
        ];
    }

    public function shopDates($this->faker)
    {
        return [
            'source_modified_at' => $this->faker->dateTimeThisYear,
        ];
    }
}

$factory->define(App\Models\Shop\Product::class, function (Faker\Generator $this->faker) {
    $part1 = ucwords($this->faker->words(2, true));
    $part2 = ucwords($this->faker->words(2, true));
    $part3 = ucwords($this->faker->words(2, true));
    $title = $part1 . ' ' . $part2 . ' ' . $part3;

    return array_merge(
        $this->shopIdsAndTitle($this->faker, $title),
        [
            'external_sku' => $this->faker->ean8,
            'description' => $this->faker->paragraph(3),
        ],
        $this->shopDates($this->faker)
    );
});
