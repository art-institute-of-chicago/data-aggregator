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


$factory->define(App\Models\Web\Closure::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'date_start' => $faker->date(),
        'date_end' => $faker->date(),
        'closure_copy' => $faker->sentence(),
        'type' => $faker->randomDigit,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});


$factory->define(App\Models\Web\Exhibition::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'header_copy' => $faker->sentence(),
        'datahub_id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'is_visible' => $faker->boolean,
        'exhibition_message' => $faker->sentence(),
        'sponsors_sub_copy' => $faker->sentence(),
        'cms_exhibition_type' => $faker->randomDigit,
        'published' => $faker->boolean,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});


$factory->define(App\Models\Web\Event::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'type' => $faker->randomDigit,
        'description' => $faker->paragraph(2),
        'short_description' => $faker->sentence(),
        'hero_caption' => $faker->sentence(),
        'is_private' => $faker->boolean,
        'is_after_hours' => $faker->boolean,
        'is_ticketed' => $faker->boolean,
        'is_free' => $faker->boolean,
        'is_member_exclusive' => $faker->boolean,
        'hidden' => $faker->boolean,
        'rsvp_link' => $faker->url,
        'start_date' => $faker->dateTimeThisYear->format('l, F j, Y'),
        'end_date' => $faker->dateTimeThisYear->format('l, F j, Y'),
        'location' => ucfirst($faker->words(3, true)),
        'sponsors_description' => $faker->sentence(),
        'sponsors_sub_copy' => $faker->sentence(),
        'layout_type' => $faker->randomDigit,
        'buy_button_text' => ucfirst($faker->words(3, true)),
        'buy_button_caption' => $faker->sentence(),
        'published' => $faker->boolean,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});


$factory->define(App\Models\Web\Article::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'date' => $faker->dateTimeThisYear,
        'copy' => $faker->paragraph(2),
        'published' => $faker->boolean,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});


$factory->define(App\Models\Web\Selection::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'short_copy' => $faker->sentence(),
        'content' => $faker->paragraph(2),
        'published' => $faker->boolean,
        'source_modified_at' => $faker->dateTimeThisYear,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
