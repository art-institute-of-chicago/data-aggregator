<?php

namespace Database\Factories;

class ProductFactory extends ShopFactory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
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
    }
}
