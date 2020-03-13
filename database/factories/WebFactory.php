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
        'list_description' => $faker->sentence(),
        'exhibition_message' => $faker->sentence(),
        'is_published' => $faker->boolean,
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
        'rsvp_link' => $faker->url,
        'start_date' => $faker->dateTimeThisYear,
        'end_date' => $faker->dateTimeThisYear,
        'location' => ucfirst($faker->words(3, true)),
        'layout_type' => $faker->randomDigit,
        'buy_button_text' => ucfirst($faker->words(3, true)),
        'buy_button_caption' => $faker->sentence(),
        'is_admission_required' => $faker->boolean,
        'ticketed_event_id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'survey_url' => $faker->url,
        'door_time' => $faker->time('H:i'),
        'image_url' => $faker->imageUrl,
        'published' => $faker->boolean,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});

$factory->define(App\Models\Web\EventProgram::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
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
        'copy' => $faker->paragraph(2),
        'published' => $faker->boolean,
        'source_modified_at' => $faker->dateTimeThisYear,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});

$factory->define(App\Models\Web\Artist::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'also_known_as' => $faker->boolean,
        'intro_copy' => $faker->paragraph(),
        'datahub_id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});

$factory->define(App\Models\Web\GenericPage::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'web_url' => $faker->url,
        'slug' => $faker->slug,
        'listing_description' => $faker->paragraph(),
        'short_description' => $faker->paragraph(),
        'published' => $faker->boolean,
        'publish_start_date' => $faker->dateTimeThisYear,
        'publish_end_date' => $faker->dateTimeThisYear,
        'copy' => $faker->paragraph(4),
        'imgix_uuid' => $faker->uuid,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});

$factory->define(App\Models\Web\PressRelease::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'web_url' => $faker->url,
        'slug' => $faker->slug,
        'listing_description' => $faker->paragraph(),
        'short_description' => $faker->paragraph(),
        'published' => $faker->boolean,
        'publish_start_date' => $faker->dateTimeThisYear,
        'publish_end_date' => $faker->dateTimeThisYear,
        'copy' => $faker->paragraph(4),
        'imgix_uuid' => $faker->uuid,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});

$factory->define(App\Models\Web\EducatorResource::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'web_url' => $faker->url,
        'slug' => $faker->slug,
        'listing_description' => $faker->paragraph(),
        'short_description' => $faker->paragraph(),
        'published' => $faker->boolean,
        'publish_start_date' => $faker->dateTimeThisYear,
        'publish_end_date' => $faker->dateTimeThisYear,
        'copy' => $faker->paragraph(4),
        'imgix_uuid' => $faker->uuid,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});

$factory->define(App\Models\Web\DigitalCatalog::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'web_url' => $faker->url,
        'slug' => $faker->slug,
        'listing_description' => $faker->paragraph(),
        'short_description' => $faker->paragraph(),
        'published' => $faker->boolean,
        'publish_start_date' => $faker->dateTimeThisYear,
        'publish_end_date' => $faker->dateTimeThisYear,
        'copy' => $faker->paragraph(4),
        'imgix_uuid' => $faker->uuid,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});

$factory->define(App\Models\Web\PrintedCatalog::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
        'title' => ucfirst($faker->words(3, true)),
        'web_url' => $faker->url,
        'slug' => $faker->slug,
        'listing_description' => $faker->paragraph(),
        'short_description' => $faker->paragraph(),
        'published' => $faker->boolean,
        'publish_start_date' => $faker->dateTimeThisYear,
        'publish_end_date' => $faker->dateTimeThisYear,
        'copy' => $faker->paragraph(4),
        'imgix_uuid' => $faker->uuid,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
