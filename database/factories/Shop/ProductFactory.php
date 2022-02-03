<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Product;

class ProductFactory extends ShopFactory
{
    protected $model = Product::class;

    public function definition()
    {
        $part1 = ucwords($this->faker->words(2, true));
        $part2 = ucwords($this->faker->words(2, true));
        $part3 = ucwords($this->faker->words(2, true));
        $title = $part1 . ' ' . $part2 . ' ' . $part3;

        return array_merge(
            $this->shopIdsAndTitle($title),
            [
                'external_sku' => $this->faker->ean8,
                'description' => $this->faker->paragraph(3),
            ],
            $this->shopDates()
        );
    }
}
