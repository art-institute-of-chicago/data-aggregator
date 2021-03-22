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
            'external_sku' => $faker->ean8,
            'description' => $faker->paragraph(3),
        ],
        shopDates($faker)
    );
});
