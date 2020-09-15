<?php

/*
|--------------------------------------------------------------------------
| Web
|--------------------------------------------------------------------------
|
| Create models with stub data for all data coming from the Web CMS API.
|
*/

$factory->define(App\Models\Web\Closure::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'date_start' => $faker->date(),
        'date_end' => $faker->date(),
        'type' => $faker->randomDigit,
    ];
});

$factory->define(App\Models\Web\Exhibition::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4),
        'title' => ucfirst($faker->words(3, true)),
        'is_published' => true,
        'datahub_id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
    ];
});

$factory->define(App\Models\Web\Event::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'is_private' => false,
        'published' => true,
        'layout_type' => $faker->randomDigit,
    ];
});

$factory->define(App\Models\Web\EventProgram::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
    ];
});

$factory->define(App\Models\Web\Article::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'published' => true,
    ];
});

$factory->define(App\Models\Web\Selection::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'published' => true,
    ];
});

$factory->define(App\Models\Web\Artist::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'datahub_id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
    ];
});

$factory->define(App\Models\Web\GenericPage::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'published' => true,
    ];
});

$factory->define(App\Models\Web\PressRelease::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'published' => true,
    ];
});

$factory->define(App\Models\Web\EducatorResource::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'published' => true,
    ];
});

$factory->define(App\Models\Web\DigitalCatalog::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'published' => true,
    ];
});

$factory->define(App\Models\Web\PrintedCatalog::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'published' => true,
    ];
});
