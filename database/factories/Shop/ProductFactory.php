<?php

namespace Database\Factories\Shop;

class ProductFactory extends ShopFactory
{
    protected $model = \App\Models\Shop\Product::class;

    public function definition()
    {
        $part1 = ucwords(fake()->words(2, true));
        $part2 = ucwords(fake()->words(2, true));
        $part3 = ucwords(fake()->words(2, true));
        $title = $part1 . ' ' . $part2 . ' ' . $part3;

        return array_merge(
            $this->shopIdsAndTitle($title),
            [
                'external_sku' => fake()->ean8,
                'description' => fake()->paragraph(3),
            ],
            $this->shopDates()
        );
    }
}
