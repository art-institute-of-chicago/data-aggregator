<?php

/*
|--------------------------------------------------------------------------
| Digital Labels Factory
|--------------------------------------------------------------------------
|
| Create models with stub data for all data coming from Digital Labels.
|
*/

$factory->define(App\Models\DigitalLabel\Exhibition::class, function (Faker\Generator $faker) {
    $id = $faker->unique()->randomNumber(6) + 999 * pow(10, 6);
    return [
        'id' => $id,
        'title' => ucfirst($faker->words(3, true)),
        'exhibition_citi_id' => $faker->randomElement(App\Models\Collections\Exhibition::fake()->pluck('citi_id')->all()),
        'color' => $faker->hexcolor,
        'background_color' => $faker->hexcolor,
        'is_published' => $faker->boolean,
        'source_created_at' => $faker->date($format = 'Y-m-d'),
        'source_modified_at' => $faker->date($format = 'Y-m-d'),
    ];
});

$factory->define(App\Models\DigitalLabel\Label::class, function (Faker\Generator $faker) {
    $id = $faker->unique()->randomNumber(6) + 999 * pow(10, 6);
    return [
        'id' => $id,
        'title' => ucfirst($faker->words(3, true)),
        'digital_label_exhibition_id' => $faker->randomElement(App\Models\DigitalLabel\Exhibition::fake()->pluck('id')->all()),
        'type' => $faker->randomElement(['IMAGE', 'EXPLORER']),
        'copy_text' => $faker->sentences(2, true),
        'image_url' => $faker->imageUrl,
        'is_published' => $faker->boolean,
        'source_created_at' => $faker->date($format = 'Y-m-d'),
        'source_modified_at' => $faker->date($format = 'Y-m-d'),
    ];
});
