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

$factory->define(App\Collections\Artwork::class, function (Faker\Generator $faker) {
    $citi_id = $faker->unique()->randomNumber(6);
    $lake_id = $faker->uuid;
    $title = ucwords($faker->words(4, true));
    $date_end = $faker->year;
    $medium = ucfirst($faker->word) .' on ' .$faker->word;
    $artist = App\Collections\Artist::where('lake_uid', '=', $faker->randomElement(App\Collections\Artist::all()->pluck('lake_uid')->all()))->firstOrFail();
    $department = App\Collections\Department::where('lake_uid', '=', $faker->randomElement(App\Collections\Department::all()->pluck('lake_uid')->all()))->firstOrFail();
    return [
        'api_id' => $citi_id,
        'title' => $title,
        'citi_id' => $citi_id,
        'main_id' => $faker->randomFloat(3, 1900, 2018),
        'lake_uid' => 'WO-' .$citi_id,
        'lake_guid' => $lake_id,
        'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'title_raw' => $title,
        'title_display' => $title,
        'date_start' => $faker->year,
        'date_end' => $date_end,
        'date_display' => '' .$date_end,
        'creator_lake_uid' => $artist->lake_uid,
        'creator_raw' => $artist->title_raw,
        'creator_display' => $artist->title_raw ."\n" .$faker->country .', ' .$faker->year .'–' .$faker->year,
        'department_lake_uid' => $department->lake_uid,
        'department_display' => $department->title_raw,
        'dimensions' => $faker->randomFloat(1, 0, 200) .' x ' .$faker->randomFloat(1, 0, 200) .' (' .$faker->randomNumber(2) .$faker->randomElement(['', ' 1/8', ' 1/4', ' 3/8', ' 1/2', ' 5/8', ' 3/4', ' 7/8']) .' x ' .$faker->randomNumber(2) .$faker->randomElement(['', ' 1/8', ' 1/4', ' 3/8', ' 1/2', ' 5/8', ' 3/4', ' 7/8']) .' in.)',
        'medium_raw' => $medium,
        'medium_display' => $medium,
        'inscriptions' => $faker->words(4, true),
        'credit_line' => $faker->randomElement(['', 'Friends of ', 'Gift of ', 'Bequest of ']) .$faker->words(3, true),
        'history_publications' => $faker->paragraph(5),
        'history_exhibitions' => $faker->paragraph(5),
        'history_provenance' => $faker->paragraph(5),
        'api_created_at' => $faker->dateTimeThisYear,
        'api_created_by' => $faker->userName,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_modified_by' => $faker->userName,
     ];
});

$factory->define(App\Collections\Artist::class, function (Faker\Generator $faker) {
    $citi_id = $faker->unique()->randomNumber(6);
    $lake_id = $faker->uuid;
    $title = ucwords($faker->lastName .', ' .$faker->firstName);
    return [
        'api_id' => $citi_id,
        'title' => $title,
        'citi_id' => $citi_id,
        'lake_uid' => 'AG-' .$citi_id,
        'lake_guid' => $lake_id,
        'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'title_raw' => $title,
        'title_display' => $title,
        'api_created_at' => $faker->dateTimeThisYear,
        'api_created_by' => $faker->userName,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_modified_by' => $faker->userName,
     ];
});

$factory->define(App\Collections\Gallery::class, function (Faker\Generator $faker) {
    $citi_id = $faker->unique()->randomNumber(6);
    $lake_id = $faker->uuid;
    $title = ucwords($faker->lastName .', ' .$faker->firstName);
    return [
        'api_id' => $citi_id,
        'title' => $title,
        'citi_id' => $citi_id,
        'lake_uid' => 'PL-' .$citi_id,
        'lake_guid' => $lake_id,
        'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'title_raw' => $title,
        'title_display' => $title,
        'closed' => $faker->boolean(25),
        'number' => $faker->randomNumber(3),
        'floor' => $faker->randomElement([1,2,3]), 
        'category' => ucfirst($faker->word) .' Art ' .$faker->randomElement(['before', 'after']) .$faker->year,
        'api_created_at' => $faker->dateTimeThisYear,
        'api_created_by' => $faker->userName,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_modified_by' => $faker->userName,
     ];
});

$factory->define(App\Collections\Department::class, function (Faker\Generator $faker) {
    $citi_id = $faker->unique()->randomNumber(6);
    $lake_id = $faker->uuid;
    $title = ucfirst($faker->word) .' Art';
    return [
        'api_id' => $citi_id,
        'title' => $title,
        'citi_id' => $citi_id,
        'lake_uid' => 'DE-' .$citi_id,
        'lake_guid' => $lake_id,
        'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'title_raw' => $title,
        'title_display' => $title,
        'api_created_at' => $faker->dateTimeThisYear,
        'api_created_by' => $faker->userName,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_modified_by' => $faker->userName,
     ];
});

$factory->define(App\Collections\Theme::class, function (Faker\Generator $faker) {
    $citi_id = $faker->unique()->randomNumber(6);
    $lake_id = $faker->uuid;
    $title = ucwords($faker->words(3, true));
    return [
        'api_id' => $citi_id,
        'title' => $title,
        'citi_id' => $citi_id,
        'lake_uid' => 'DE-' .$citi_id,
        'lake_guid' => $lake_id,
        'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'title_raw' => $title,
        'title_display' => $title,
        'description' => $faker->paragraph(3),
        'is_in_navigation' => ucfirst($faker->boolean),
        'sort' => $faker->randomDigit * 10,
        'api_created_at' => $faker->dateTimeThisYear,
        'api_created_by' => $faker->userName,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_modified_by' => $faker->userName,
     ];
});

$factory->define(App\Collections\Video::class, function (Faker\Generator $faker) {
    $citi_id = $faker->unique()->randomNumber(6);
    $lake_id = $faker->uuid;
    $title = ucwords($faker->words(3, true));
    $artist = App\Collections\Artist::where('lake_uid', '=', $faker->randomElement(App\Collections\Artist::all()->pluck('lake_uid')->all()))->firstOrFail();
    return [
        'api_id' => $citi_id,
        'title' => $title,
        'citi_id' => $citi_id,
        'lake_uid' => 'DE-' .$citi_id,
        'lake_guid' => $lake_id,
        'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'title_raw' => $title,
        'title_display' => $title,
        'description' => $faker->paragraph(3),
        'artist_uri' => $artist->lake_uri,
        'artist_name' => $artist->title,
        'asset_type' => $faker->randomElement(['Video','Animation/Flash']),
        'asset_url' => $faker->url,
        'curriculum' => implode(',', $faker->randomElements(['Fine Arts', 'Science', 'Social Science/History', 'Language Arts'], $faker->numberBetween(1,3))),
        'grade_level' => implode(',', $faker->randomElements(['High School', 'Middle School', 'Elementary', 'Early Childhood'], $faker->numberBetween(1,3))),
        'resource_type' => implode(',', $faker->randomElements(['Video', "Artists' Tools and Techniques", 'Online Game or Interactive', 'Artwork and Artist Information', 'Orientation and Education', 'Historical or Contextual Information', 'Gallery Panorama', 'Modern Wing Focus', 'Conservation Information'], $faker->numberBetween(1,2))),
        'api_created_at' => $faker->dateTimeThisYear,
        'api_created_by' => $faker->userName,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_modified_by' => $faker->userName,
     ];
});

$factory->define(App\Collections\Sound::class, function (Faker\Generator $faker) {
    $citi_id = $faker->unique()->randomNumber(6);
    $lake_id = $faker->uuid;
    $title = ucwords($faker->words(3, true));
    return [
        'api_id' => $citi_id,
        'title' => $title,
        'citi_id' => $citi_id,
        'lake_uid' => 'DE-' .$citi_id,
        'lake_guid' => $lake_id,
        'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'title_raw' => $title,
        'title_display' => $title,
        'type' => 'http://definitions.artic.edu/doctypes/' .$faker->randomElement(['DESound', 'General']),
        'api_created_at' => $faker->dateTimeThisYear,
        'api_created_by' => $faker->userName,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_modified_by' => $faker->userName,
     ];
});

$factory->define(App\Collections\Text::class, function (Faker\Generator $faker) {
    $citi_id = $faker->unique()->randomNumber(6);
    $lake_id = $faker->uuid;
    $title = ucwords($faker->words(3, true));
    return [
        'api_id' => $citi_id,
        'title' => $title,
        'citi_id' => $citi_id,
        'lake_uid' => 'DE-' .$citi_id,
        'lake_guid' => $lake_id,
        'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'title_raw' => $title,
        'title_display' => $title,
        'title_alt' => ucwords($faker->words(3, true)),
        'curriculum' => implode(',', $faker->randomElements(['Fine Arts', 'Science', 'Social Science/History', 'Language Arts'], $faker->numberBetween(1,3))),
        'grade_level' => implode(',', $faker->randomElements(['High School', 'Middle School', 'Elementary', 'Early Childhood'], $faker->numberBetween(1,3))),
        'resource_type' => implode(',', $faker->randomElements(['Video', "Artists' Tools and Techniques", 'Online Game or Interactive', 'Artwork and Artist Information', 'Orientation and Education', 'Historical or Contextual Information', 'Gallery Panorama', 'Modern Wing Focus', 'Conservation Information'], $faker->numberBetween(1,2))),
        'api_created_at' => $faker->dateTimeThisYear,
        'api_created_by' => $faker->userName,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_modified_by' => $faker->userName,
     ];
});

$factory->define(App\Collections\Image::class, function (Faker\Generator $faker) {
    $citi_id = $faker->unique()->randomNumber(6);
    $lake_id = $faker->uuid;
    $title = ucwords($faker->words(3, true));
    return [
        'api_id' => $citi_id,
        'title' => $title,
        'citi_id' => $citi_id,
        'lake_uid' => 'DE-' .$citi_id,
        'lake_guid' => $lake_id,
        'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        'title_raw' => $title,
        'title_display' => $title,
        'imaging_uid' => $faker->randomElement(['A', 'D', 'E', 'G', 'PD_', 'PH_', 'AS_']) .$faker->randomNumber(5),
        'type' => 'http://definitions.artic.edu/doctypes/' .$faker->randomElement(['Imaging', 'CuratorialStillImage']),
        'api_created_at' => $faker->dateTimeThisYear,
        'api_created_by' => $faker->userName,
        'api_modified_at' => $faker->dateTimeThisYear,
        'api_modified_by' => $faker->userName,
     ];
});

