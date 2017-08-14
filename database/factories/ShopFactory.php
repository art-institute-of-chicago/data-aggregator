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

if (!function_exists('shopIdsAndTitle'))
{
    function shopIdsAndTitle($faker, $title = '')
    {

        return [
            'shop_id' => $faker->unique()->randomNumber(3),
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


$factory->define(App\Models\Shop\Category::class, function (Faker\Generator $faker) {
    return array_merge(
        shopIdsAndTitle($faker),
        [
            'link' => $faker->url,
            'type' => $faker->randomElement(['top-category', 'sub-category', 'artist', 'color', 'country', 'style', 'place-of-origin', 'stone', 'sale']),
            'source_id' => $faker->randomNumber(2),
        ],
        shopDates($faker)
    );
});

$factory->define(App\Models\Shop\Product::class, function (Faker\Generator $faker) {
    $part1 = ucwords($faker->words(2, true));
    $part2 = ucwords($faker->words(2, true));
    $part3 = ucwords($faker->words(2, true));
    $title = $part1 .' ' .$part2 .' ' .$part3;
    $title_display = $part1 .' <em>' .$part2 .'</em> ' .$part3;

    return array_merge(
        shopIdsAndTitle($faker, $title),
        [
            'sku' => $faker->ean8,
            'title_display' => $title_display,
            'link' => $faker->url,
            'image' => $faker->imageUrl,
            'description' => $faker->paragraph(3),
            'on_sale' => $faker->boolean,
            'priority' => $faker->randomDigit,
            'price' => $faker->randomFloat(2, 5, 300),
            'review_count' => $faker->randomNumber(2),
            'items_sold' => $faker->randomNumber(2),
            'rating' => $faker->randomFloat(1, 0, 5),
        ],
        shopDates($faker)
    );
});

