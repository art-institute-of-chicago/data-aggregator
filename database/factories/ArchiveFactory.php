<?php

/*
|--------------------------------------------------------------------------
| Archive Factory
|--------------------------------------------------------------------------
|
| Create models with stub data for all data coming from the Archive
| Data Service.
|
*/

$factory->define(App\Models\Archive\ArchivalImage::class, function (Faker\Generator $faker) {
    $id = $faker->unique()->randomNumber(6) + 999 * pow(10, 6);
    return [
        'id' => $id,
        'title' => ucfirst($faker->words(3, true)),
        'alternate_title' => ucfirst($faker->words(3, true)),
        'collection' => ucfirst($faker->words(3, true)) .' Collection',
        'archive' => ucfirst($faker->words(3, true)) .' Archive',
        'format' => ucfirst($faker->word),
        'file_format' => 'TIFF',
        'file_size' => $faker->randomNumber(5),
        'pixel_dimensions' => $faker->randomNumber(4) .' x ' .$faker->randomNumber(4),
        'color' => ucfirst($faker->word),
        'physical_notes' => ucfirst($faker->word),
        'date' => $faker->year .($faker->boolean ? '-' .$faker->year : ''),
        'date_view' => 'c. ' .$faker->year,
        'date_object' => '',
        'creator' => $faker->name,
        'additional_creator' => $faker->name,
        'main_id' => '',
        'subject_terms' => ['Chicago', 'Building--Steel frame'],
        'view' => ucfirst($faker->word),
        'image_notes' => ucfirst($faker->word),
        'file_name' => $id .'_2.jpg',
        'source_created_at' => $faker->date($format = 'Y-m-d'),
        'source_modified_at' => $faker->date($format = 'Y-m-d'),
    ];
});
