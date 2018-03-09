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
