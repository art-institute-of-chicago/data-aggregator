<?php

/*
|--------------------------------------------------------------------------
| Shop Factory
|--------------------------------------------------------------------------
|
| Create models with stub data for all data coming from the Shop
| Data Service.
|
*/

if (!function_exists('shopIdsAndTitle')) {
    function shopIdsAndTitle($faker, $title = '')
    {
        return [
            'shop_id' => $faker->unique()->randomNumber(3) + 999 * pow(10, 3),
            'title' => $title ? $title : ucfirst($faker->words(5, true)),
        ];
    }

    function shopDates($faker)
    {
        return [
            'source_created_at' => $faker->dateTimeThisYear,
            'source_modified_at' => $faker->dateTimeThisYear,
        ];
    }
}

$factory->define(App\Models\Shop\Product::class, function (Faker\Generator $faker) {
    $part1 = ucwords($faker->words(2, true));
    $part2 = ucwords($faker->words(2, true));
    $part3 = ucwords($faker->words(2, true));
    $title = $part1 . ' ' . $part2 . ' ' . $part3;

    return array_merge(
        shopIdsAndTitle($faker, $title),
        [
            'sku' => $faker->ean8,
            'external_sku' => $faker->ean8,
            'image_url' => $faker->imageUrl,
            'description' => $faker->paragraph(3),
            'priority' => $faker->randomDigit,
            'price' => $faker->randomFloat(2, 5, 300),
            'aic_collection' => $faker->boolean,
            'gift_box' => $faker->boolean,
            'holiday' => $faker->boolean,
            'architecture' => $faker->boolean,
            'glass' => $faker->boolean,
            'active' => true,
        ],
        shopDates($faker)
    );
});
