<?php

/*
|--------------------------------------------------------------------------
| Library Factory
|--------------------------------------------------------------------------
|
| Create models with stub data for all data coming from the Library
| Data Service.
|
*/

$factory->define(App\Models\Library\Material::class, function (Faker\Generator $faker) {
    $id = env('PRIMO_API_SOURCE') .'999' .$faker->unique()->randomNumber(8);
    return [
        'id' => $id,
        'title' => ucfirst($faker->words(3, true)),
        'date' => $faker->year(),
    ];
});

$factory->define(App\Models\Library\Term::class, function (Faker\Generator $faker) {
    $id = 'zz' .$faker->unique()->randomNumber(8);
    return [
        'id' => $id,
        'uri' => 'http://fake.loc.fake/authorities/fake/' .$id,
        'title' => ucfirst($faker->words(3, true)),
    ];
});
