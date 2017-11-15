<?php

/*
|--------------------------------------------------------------------------
| Static Factory
|--------------------------------------------------------------------------
|
| Create models with stub data for all data coming from the Static Archive
| Data Service.
|
*/

$factory->define(App\Models\StaticArchive\Site::class, function (Faker\Generator $faker) {
    return [
        'site_id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'description' => $faker->paragraph(5),
        'web_url' => $faker->url,
    ];
});
