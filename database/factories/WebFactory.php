<?php

/*
|--------------------------------------------------------------------------
| Web
|--------------------------------------------------------------------------
|
| Create models with stub data for all data coming from the Web CMS API.
|
*/

$factory->define(App\Models\Web\Tag::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'name' => ucfirst($faker->words(3, true)),
        'source_modified_at' => $faker->dateTimeThisYear,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});


$factory->define(App\Models\Web\Location::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'name' => ucfirst($faker->words(3, true)),
        'street' => $faker->streetAddress,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip' => $faker->postcode,
        'published' => $faker->boolean,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});


$factory->define(App\Models\Web\Hour::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'opening_time' => $faker->dateTimeThisYear,
        'closing_time' => $faker->dateTimeThisYear,
        'type' => $faker->randomDigit,
        'day_of_week' => $faker->randomDigit,
        'closed' => $faker->boolean,
        'source_modified_at' => $faker->dateTimeThisYear,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
