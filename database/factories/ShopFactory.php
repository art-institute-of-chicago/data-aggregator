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
    function shopIdsAndTitle($faker)
    {
    
        return [
            'shop_id' => $faker->unique()->randomNumber(3),
            'title' => ucfirst($faker->words(5, true)),
        ];

    }

    function shopDates($faker)
    {
                                                        
        return [
            'api_created_at' => $faker->dateTimeThisYear,
            'api_modified_at' => $faker->dateTimeThisYear,
        ];

    }
                                                    
}


$factory->define(App\Shop\Category::class, function (Faker\Generator $faker) {
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

