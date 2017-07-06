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

$factory->define(App\StaticArchive\Site::class, function (Faker\Generator $faker) {
    return [
        'site_id' => $faker->unique()->randomNumber(4),
        'title' => ucfirst($faker->words(3, true)),
        'description' => $faker->paragraph(5),
        'link' => $faker->url,
        'exhibition_citi_id' => $faker->randomElement(App\Collections\Exhibition::all()->pluck('citi_id')->all()),
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
    ];
});
