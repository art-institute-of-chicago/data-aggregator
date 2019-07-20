<?php

/*
|--------------------------------------------------------------------------
| DSC Factory
|--------------------------------------------------------------------------
|
| Create models with stub data for all data coming from the DSC
| Data Service.
|
*/

if (!function_exists('dscIdsAndTitle'))
{
    function dscIdsAndTitle($faker, $id = '')
    {

        return [
            'dsc_id' => $id ?: $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
            'title' => ucfirst($faker->words(3, true)),
        ];

    }

}


$factory->define(App\Models\Dsc\Publication::class, function (Faker\Generator $faker) {
    return array_merge(
        dscIdsAndTitle($faker),
        [

            'web_url' => $faker->url,
            'site' => implode('', $faker->words(2)),
            'alias' => implode('', $faker->words(2)),

        ]
    );
});

$factory->define(App\Models\Dsc\Section::class, function (Faker\Generator $faker) {
    return array_merge(
        dscIdsAndTitle($faker),
        [

            'web_url' => $faker->url,
            'accession' => $faker->accession,
            'revision' => rand(1230768000, 1483228800), // timestamp b/w 2009 and 2017
            'source_id' => $faker->randomNumber(5),
            'weight' => $faker->randomNumber(2),
            'parent_id' => !rand(0, 3) ? null : $faker->randomElement(App\Models\Dsc\Section::fake()->pluck('dsc_id')->all()),
            'publication_dsc_id' => $faker->randomElement(App\Models\Dsc\Publication::fake()->pluck('dsc_id')->all()),
            'artwork_citi_id' => $faker->randomElement(App\Models\Collections\Artwork::fake()->pluck('citi_id')->all()),
            'content' => $faker->paragraphs(10, true),

        ]
    );
});
