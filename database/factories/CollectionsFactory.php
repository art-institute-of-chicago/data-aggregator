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

if (!function_exists('idsAndTitle'))
{
    function idsAndTitle($faker, $title, $citiField = false, $idLength = 6)
    {
    
        $lake_id = $faker->uuid;
        $ret = [];
    
        if ($citiField)
        {
            $ret = [
                'citi_id' => $faker->unique()->randomNumber($idLength),
            ];
        }

        return array_merge(
            $ret,
            [
                'title' => $title,
                'lake_guid' => $lake_id,
                'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
            ]
        );
    
    }

    function dates($faker)
    {
                                                        
        return [
            'api_created_at' => $faker->dateTimeThisYear,
            'api_modified_at' => $faker->dateTimeThisYear,
            'api_indexed_at' => $faker->dateTimeThisYear,
        ];

    }
                                                    
}


$factory->define(App\Collections\AgentType::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, $faker->words(2, true), true, 2),
        dates($faker)
    );
});

$factory->define(App\Collections\Artist::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucwords($faker->lastName .', ' .$faker->firstName), true, 5),
        [
            'date_birth' => $faker->year,
            'date_death' => $faker->year,
            'agent_type_citi_id' => $faker->randomElement(App\Collections\AgentType::all()->pluck('citi_id')->all()),
        ],
        dates($faker)
    );
});


$factory->define(App\Collections\Department::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucfirst($faker->word) .' Art', true, 6),
        dates($faker)
    );
});


$factory->define(App\Collections\Category::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucfirst($faker->word(3, true)), true),
        [
            'description' => $faker->paragraph(3),
            'is_in_nav' => $faker->boolean,
            'parent_id' => $faker->unique()->randomNumber(3),
            'sort' => $faker->randomDigit * 5,
            'type' => $faker->randomDigit,
        ],
        dates($faker)
    );
});


$factory->define(App\Collections\Artwork::class, function (Faker\Generator $faker) {
    $date_end = $faker->year;
    $artist = factory(App\Collections\Artist::Class)->create();
    return array_merge(
        idsAndTitle($faker, ucwords($faker->words(4, true)), true, 6),
        [
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
        ],
        dates($faker)
    );
});


$factory->define(App\Collections\ArtworkDate::class, function (Faker\Generator $faker) {
    return [
        'artwork_citi_id' => $faker->randomElement(App\Collections\Artwork::all()->pluck('citi_id')->all()),
        'date' => $faker->dateTimeAd,
        'qualifier' => ucfirst($faker->word) .' date',
        'preferred' => $faker->boolean,
    ];
});


$factory->define(App\Collections\Gallery::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, $faker->randomElement(['Gallery ' .$faker->unique()->randomNumber(3), $faker->lastName .' ' .$faker->randomElement(['Hall', 'Building', 'Memorial Garden', 'Reading Room', 'Study Room'])]), true, 6),
        [
            'closed' => $faker->boolean(25),
            'number' => $faker->randomNumber(3),
            'floor' => $faker->randomElement([1,2,3]), 
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
        ],
        dates($faker)
    );
});


$factory->define(App\Collections\Theme::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucwords($faker->words(3, true)), true, 6),
        [
            'description' => $faker->paragraph(3),
            'is_in_navigation' => ucfirst($faker->boolean),
            'sort' => $faker->randomDigit * 10,
        ],
        dates($faker)
    );
});


$factory->define(App\Collections\Link::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucwords($faker->words(3, true))),
        [
            'description' => $faker->paragraph(3),
            'content' => $faker->url,
            'published' => $faker->boolean,
            'artist_citi_id' => $faker->randomElement(App\Collections\Artist::all()->pluck('citi_id')->all()),
        ],
        dates($faker)
    );
});


$factory->define(App\Collections\Sound::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucwords($faker->words(3, true))),
        [
            'description' => $faker->paragraph(3),
            'content' => $faker->url,
            'published' => $faker->boolean,
            'artist_citi_id' => $faker->randomElement(App\Collections\Artist::all()->pluck('citi_id')->all()),
        ],
        dates($faker)
    );
});


$factory->define(App\Collections\Video::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucwords($faker->words(3, true))),
        [
            'description' => $faker->paragraph(3),
            'content' => $faker->url,
            'published' => $faker->boolean,
            'artist_citi_id' => $faker->randomElement(App\Collections\Artist::all()->pluck('citi_id')->all()),
        ],
        dates($faker)
    );
});


$factory->define(App\Collections\Text::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucwords($faker->words(3, true))),
        [
            'description' => $faker->paragraph(3),
            'content' => $faker->url,
            'published' => $faker->boolean,
            'artist_citi_id' => $faker->randomElement(App\Collections\Artist::all()->pluck('citi_id')->all()),
        ],
        dates($faker)
    );
});


$factory->define(App\Collections\Image::class, function (Faker\Generator $faker) {
    $lake_id = $faker->uuid;
    return array_merge(
        idsAndTitle($faker, ucwords($faker->words(3, true))),
        [
            'description' => $faker->paragraph(3),
            'content' => $faker->url,
            'published' => $faker->boolean,
            'artwork_citi_id' => $faker->randomElement(App\Collections\Artwork::all()->pluck('citi_id')->all()),
            'imaging_uid' => $faker->randomElement(['A', 'D', 'E', 'G', 'PD_', 'PH_', 'AS_']) .$faker->randomNumber(5),
            'type' => 'http://definitions.artic.edu/doctypes/' .$faker->randomElement(['Imaging', 'CuratorialStillImage']),
            'iiif_url' => env('LAKE_URL', 'https://localhost/iiif') .'/' .$lake_id .'/info.json',
        ],
        dates($faker)
    );
});


