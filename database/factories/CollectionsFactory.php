<?php

/*
|--------------------------------------------------------------------------
| Collections Factory
|--------------------------------------------------------------------------
|
| Create an models with stub data for all data coming from the Collections
| Data Service.
|
*/

$factory->define(App\Collections\Artist::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;
    return [
        'citi_id' => $faker->unique()->randomNumber(5),
        'title' => ucwords($faker->lastName .', ' .$faker->firstName),
        'lake_guid' => $lake_id,
        'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'date_birth' => $faker->year,
        'date_death' => $faker->year,
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_indexed_at' => $faker->dateTimeThisYear,
     ];
});


$factory->define(App\Collections\Department::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;
    return [
        'citi_id' => $faker->unique()->randomNumber(6),
        'title' => ucfirst($faker->word) .' Art',
        'lake_guid' => $lake_id,
        'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_indexed_at' => $faker->dateTimeThisYear,
     ];
});


$factory->define(App\Collections\Category::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;
    return [
        'citi_id' => $faker->unique()->randomNumber(3),
        'title' => ucwords($faker->words(3, true)),
        'lake_guid' => $lake_id,
        'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'description' => $faker->paragraph(3),
        'is_in_nav' => $faker->boolean,
        'parent_id' => $faker->unique()->randomNumber(3),
        'sort' => $faker->randomDigit * 5,
        'type' => $faker->randomDigit,
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_indexed_at' => $faker->dateTimeThisYear,
     ];
});


$factory->define(App\Collections\Artwork::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;
    $date_end = $faker->year;
    $artist = App\Collections\Artist::find($faker->randomElement(App\Collections\Artist::all()->pluck('citi_id')->all()));
    return [
        'citi_id' => $faker->unique()->randomNumber(6),
        'title' => ucwords($faker->words(4, true)),
        'lake_guid' => $lake_id,
        'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'main_id' => $faker->randomFloat(3, 1900, 2018),
        'date_display' => '' .$date_end,
        'date_start' => $faker->year,
        'date_end' => $date_end,
        'artist_citi_id' => $artist->citi_id,
        'artist_display' => $artist->title_raw ."\n" .$faker->country .', ' .$faker->year .'–' .$faker->year,
        'department_citi_id' => $faker->randomElement(App\Collections\Department::all()->pluck('citi_id')->all()),
        'dimensions' => $faker->randomFloat(1, 0, 200) .' x ' .$faker->randomFloat(1, 0, 200) .' (' .$faker->randomNumber(2) .$faker->randomElement(['', ' 1/8', ' 1/4', ' 3/8', ' 1/2', ' 5/8', ' 3/4', ' 7/8']) .' x ' .$faker->randomNumber(2) .$faker->randomElement(['', ' 1/8', ' 1/4', ' 3/8', ' 1/2', ' 5/8', ' 3/4', ' 7/8']) .' in.)',
        'medium' => ucfirst($faker->word) .' on ' .$faker->word,
        'credit_line' => $faker->randomElement(['', 'Friends of ', 'Gift of ', 'Bequest of ']) .$faker->words(3, true),
        'inscriptions' => $faker->words(4, true),
        'publications' => $faker->paragraph(5),
        'exhibitions' => $faker->paragraph(5),
        'provenance' => $faker->paragraph(5),
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_indexed_at' => $faker->dateTimeThisYear,
     ];
});


$factory->define(App\Collections\Gallery::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;
    return [
        'citi_id' => $faker->unique()->randomNumber(6),
        'title' => $faker->randomElement(['Gallery ' .$faker->unique()->randomNumber(3), $faker->lastName .' ' .$faker->randomElement(['Hall', 'Building', 'Memorial Garden', 'Reading Room', 'Study Room'])]),
        'lake_guid' => $lake_id,
        'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'closed' => $faker->boolean(25),
        'number' => $faker->randomNumber(3),
        'floor' => $faker->randomElement([1,2,3]), 
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_indexed_at' => $faker->dateTimeThisYear,
     ];
});


$factory->define(App\Collections\Theme::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;
    return [
        'citi_id' => $faker->unique()->randomNumber(6),
        'title' => ucwords($faker->words(3, true)),
        'lake_guid' => $lake_id,
        'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'description' => $faker->paragraph(3),
        'is_in_navigation' => ucfirst($faker->boolean),
        'sort' => $faker->randomDigit * 10,
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_indexed_at' => $faker->dateTimeThisYear,
     ];
});


$factory->define(App\Collections\Link::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;

    return [
        'title' => ucwords($faker->words(3, true)),
        'lake_guid' => $lake_id,
        'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'description' => $faker->paragraph(3),
        'content' => $faker->url,
        'published' => $faker->boolean,
        'artist_citi_id' => $faker->randomElement(App\Collections\Artist::all()->pluck('citi_id')->all()),
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_indexed_at' => $faker->dateTimeThisYear,
     ];
});


$factory->define(App\Collections\Sound::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;

    return [
        'title' => ucwords($faker->words(3, true)),
        'lake_guid' => $lake_id,
        'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'description' => $faker->paragraph(3),
        'content' => $faker->url,
        'published' => $faker->boolean,
        'artist_citi_id' => $faker->randomElement(App\Collections\Artist::all()->pluck('citi_id')->all()),
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_indexed_at' => $faker->dateTimeThisYear,
     ];
});


$factory->define(App\Collections\Video::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;

    return [
        'title' => ucwords($faker->words(3, true)),
        'lake_guid' => $lake_id,
        'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'description' => $faker->paragraph(3),
        'content' => $faker->url,
        'published' => $faker->boolean,
        'artist_citi_id' => $faker->randomElement(App\Collections\Artist::all()->pluck('citi_id')->all()),
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_indexed_at' => $faker->dateTimeThisYear,
     ];
});


$factory->define(App\Collections\Text::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;

    return [
        'title' => ucwords($faker->words(3, true)),
        'lake_guid' => $lake_id,
        'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'description' => $faker->paragraph(3),
        'content' => $faker->url,
        'published' => $faker->boolean,
        'artist_citi_id' => $faker->randomElement(App\Collections\Artist::all()->pluck('citi_id')->all()),
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_indexed_at' => $faker->dateTimeThisYear,
     ];
});


$factory->define(App\Collections\Image::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;
    return [
        'title' => $faker->randomElement(['A', 'D', 'G', 'PD_', 'PH_', 'AS_', 'IM00']) .$faker->randomNumber(5, true),
        'lake_guid' => $lake_id,
        'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'imaging_uid' => $faker->randomElement(['A', 'D', 'E', 'G', 'PD_', 'PH_', 'AS_']) .$faker->randomNumber(5),
        'type' => 'http://definitions.artic.edu/doctypes/' .$faker->randomElement(['Imaging', 'CuratorialStillImage']),
        'iiif_url' => env('LAKE_URL', 'https://localhost/iiif') .'/' .$lake_id .'/info.json',
        'api_created_at' => $faker->dateTimeThisYear,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_indexed_at' => $faker->dateTimeThisYear,
     ];
});


