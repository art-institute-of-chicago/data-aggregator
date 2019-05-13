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
        $ret = [];

        if ($citiField)
        {
            $ret = [
                'citi_id' => $faker->unique()->randomNumber($idLength) + 999 * pow(10, $idLength),
            ];
        }

        return array_merge(
            $ret,
            [
                'title' => $title,
            ]
        );

    }

    function dates($faker, $citiField = false)
    {

        $ret = [
            'source_modified_at' => $faker->dateTimeThisYear,
        ];

        return $ret;

    }

}


$factory->define(App\Models\Collections\AgentType::class, function (Faker\Generator $faker) {
    return idsAndTitle($faker, $faker->unique()->randomElement(['Individual', 'Corporate Body', $faker->words(2, true)]), true, 2);
});

$factory->define(App\Models\Collections\AgentRole::class, function (Faker\Generator $faker) {
    return idsAndTitle($faker, $faker->words(3, true), true, 2);
});

$factory->define(App\Models\Collections\Agent::class, function (Faker\Generator $faker) {

    $first_name = $faker->firstName;
    $last_name = $faker->lastName;

    return array_merge(
        idsAndTitle($faker, ucwords($first_name.' '.$last_name), true, 6),
        [
            'sort_title' => $last_name .', ' .$first_name,
            'alt_titles' => [],
            'birth_date' => $faker->year,
            'death_date' => $faker->year,
            'birth_place' => $faker->country,
            'death_place' => $faker->country,
            'licensing_restricted' => $faker->boolean,
            'agent_type_citi_id' => $faker->randomElement(App\Models\Collections\AgentType::fake()->pluck('citi_id')->all()),
        ],
        dates($faker, true)
    );
});


$factory->define(App\Models\Collections\ArtworkType::class, function (Faker\Generator $faker) {
    return idsAndTitle($faker, $faker->randomElement(['Painting', 'Design', 'Drawing and ' .ucfirst($faker->word), ucfirst($faker->word) .' Arts', 'Sculpture']), true, 2);
});


$factory->define(App\Models\Collections\ArtworkPlaceQualifier::class, function (Faker\Generator $faker) {
    return idsAndTitle($faker, 'Object ' . $faker->word(1) . ' in', true, 2);
});


$factory->define(App\Models\Collections\Term::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucfirst($faker->word(3, true))),
        [
            'is_category' => false,
            'lake_uid' => 'TM-' .($faker->unique()->randomNumber(6) + 999 * pow(10, 6)),
            'subtype' => $faker->randomElement(['TT-1','TT-2','TT-3','TT-4','TT-5']),
        ]
    );
});


$factory->define(App\Models\Collections\Category::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucfirst($faker->word(3, true))),
        [
            'is_category' => true,
            'lake_uid' => 'PC-' .($faker->unique()->randomNumber(6) + 999 * pow(10, 6)),
            'subtype' => $faker->randomElement(['CT-1','CT-3']),
            'parent_id' => $faker->randomElement(App\Models\Collections\Category::fake()->pluck('lake_uid')->all()),
        ]
    );
});


$factory->define(App\Models\Collections\Artwork::class, function (Faker\Generator $faker) {
    $date_end = $faker->year;
    $artist = App\Models\Collections\Agent::where('agent_type_citi_id', App\Models\Collections\AgentType::where('title', 'Individual')->first()->citi_id)->get()->random();
    return array_merge(
        idsAndTitle($faker, ucwords($faker->words(4, true)), true, 6),
        [
            'main_id' => $faker->accession,
            'date_display' => '' .$date_end,
            'date_start' => $faker->year,
            'date_end' => $date_end,
            'description' => $faker->paragraph(5),
            'artist_display' => $artist->title_raw ."\n" .$faker->country .', ' .$faker->year .'–' .$faker->year,
            'dimensions' => $faker->randomFloat(1, 0, 200) .' x ' .$faker->randomFloat(1, 0, 200) .' (' .$faker->randomNumber(2) .$faker->randomElement(['', ' 1/8', ' 1/4', ' 3/8', ' 1/2', ' 5/8', ' 3/4', ' 7/8']) .' x ' .$faker->randomNumber(2) .$faker->randomElement(['', ' 1/8', ' 1/4', ' 3/8', ' 1/2', ' 5/8', ' 3/4', ' 7/8']) .' in.)',
            'medium_display' => ucfirst($faker->word) .' on ' .$faker->word,
            'credit_line' => $faker->randomElement(['', 'Friends of ', 'Gift of ', 'Bequest of ']) .$faker->words(3, true),
            'inscriptions' => $faker->words(4, true),
            'publication_history' => $faker->paragraph(5),
            'exhibition_history' => $faker->paragraph(5),
            'provenance' => $faker->paragraph(5),
            'publishing_verification_level' => $faker->randomElement(['Web Basic', 'Web Cataloged', 'Web Everything']),
            'is_public_domain' => $faker->boolean,
            'copyright_notice' => '© ' .$faker->year .' ' .ucfirst($faker->words(3, true)),
            'place_of_origin' => $faker->country,
            'collection_status' => $faker->randomElement(['Permanent Collection', 'Long-term Loan']),
            'artwork_type_citi_id' => $faker->randomElement(App\Models\Collections\ArtworkType::fake()->pluck('citi_id')->all()),
            'gallery_citi_id' => $faker->randomElement(App\Models\Collections\Place::fake()->pluck('citi_id')->all()),
        ],
        dates($faker, true)
    );
});

$factory->define(App\Models\Collections\ArtworkDateQualifier::class, function (Faker\Generator $faker) {
    return idsAndTitle($faker, $faker->randomElement(['Made', 'Designed', 'Reconstructed', 'Published']), true, 2);
});

$factory->define(App\Models\Collections\ArtworkDate::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, $faker->word .' date', true),
        [
            'artwork_citi_id' => $faker->randomElement(App\Models\Collections\Artwork::fake()->pluck('citi_id')->all()),
            'date_earliest' => $faker->dateTimeAd,
            'date_latest' => $faker->dateTimeAd,
            'artwork_date_qualifier_citi_id' => $faker->randomElement(App\Models\Collections\ArtworkDateQualifier::fake()->pluck('citi_id')->all()),
            'preferred' => $faker->boolean,
        ]
    );
});


$factory->define(App\Models\Collections\ArtworkTerm::class, function (Faker\Generator $faker) {
    return [
        'term' => $faker->words(2, true),
        'type' => ucfirst($faker->word)
    ];
});


$factory->define(App\Models\Collections\ArtworkCatalogue::class, function (Faker\Generator $faker) {
    return [
        'artwork_citi_id' => $faker->randomElement(App\Models\Collections\Artwork::fake()->pluck('citi_id')->all()),
        'preferred' => $faker->boolean,
        'catalogue' => ucfirst($faker->words(2, true)),
        'number' => $faker->randomNumber(2),
        'state_edition' => $faker->words(2, true),
    ];
});


$factory->define(App\Models\Collections\Gallery::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, $faker->randomElement(['Gallery ' .$faker->unique()->randomNumber(3), $faker->lastName .' ' .$faker->randomElement(['Hall', 'Building', 'Memorial Garden', 'Reading Room', 'Study Room'])]), true, 6),
        [
            'closed' => $faker->boolean(25),
            'number' => $faker->randomNumber(3) .($faker->boolean(25) ? 'A' : ''),
            'floor' => $faker->randomElement([1,2,3, 'LL']),
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'type' => 'AIC Gallery',
        ],
        dates($faker, true)
    );
});


$factory->define(App\Models\Collections\Place::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, $faker->country, true),
        [
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
        ],
        dates($faker, true)
    );
});


$factory->define(App\Models\Collections\Exhibition::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucwords($faker->words(3, true)), true),
        [
            'description' => $faker->paragraph(3),
            'type' => $faker->randomElement(['AIC Only', 'AIC & Other Venues', 'Mini Exhibition', 'Permanent Collection Special Project', 'Rotation']),
            'department_display' => ucwords($faker->words(2, true)),
            'place_citi_id' => $faker->randomElement(App\Models\Collections\Place::fake()->pluck('citi_id')->all()),
            'place_display' => 'Gallery ' .$faker->randomNumber(3),
            'status' => $faker->randomElement(['Open', 'Closed']),
            'date_start' => $faker->dateTimeAd,
            'date_end' => $faker->dateTimeAd,
            'date_aic_start' => $faker->dateTimeAd,
            'date_aic_end' => $faker->dateTimeAd,
        ],
        dates($faker, true)
    );
});


$factory->define(App\Models\Collections\Asset::class, function (Faker\Generator $faker) {
    return array_merge(
        idsAndTitle($faker, ucwords($faker->words(3, true))),
        [
            'lake_guid' => '99999999-9999-9999-9999-999999' .$faker->randomNumber(6, true),
            'content' => $faker->url,
            'copyright_notice' => '© ' .$faker->year .' ' .ucfirst($faker->words(3, true)),
            'published' => $faker->boolean,
            'description' => $faker->paragraph(3),
            'alt_text' => $faker->paragraph(3),
            'source_created_at' => $faker->dateTimeThisYear,
            'source_indexed_at' => $faker->dateTimeThisYear,
        ],
        dates($faker)
    );
});

// TODO: Laravel 5.5 allows array as 3rd argument, Laravel 5.4 requires callable
// https://laravel.com/docs/5.4/database-testing#factory-states
// https://laravel.com/docs/5.5/database-testing#factory-states

$factory->state(App\Models\Collections\Asset::class, 'image', function (Faker\Generator $faker) {
    return [
        'type' => 'image',
    ];
});

$factory->state(App\Models\Collections\Asset::class, 'sound', function (Faker\Generator $faker) {
    return [
        'type' => 'sound',
    ];
});

$factory->state(App\Models\Collections\Asset::class, 'text', function (Faker\Generator $faker) {
    return [
        'type' => 'text',
    ];
});

$factory->state(App\Models\Collections\Asset::class, 'video', function (Faker\Generator $faker) {
    return [
        'type' => 'video',
    ];
});

// Soft-links to the Asset factory + state:

$factory->define(App\Models\Collections\Image::class, function (Faker\Generator $faker) {
    return factory( App\Models\Collections\Asset::class )->states('image')->raw();
});

$factory->define(App\Models\Collections\Sound::class, function (Faker\Generator $faker) {
    return factory( App\Models\Collections\Asset::class )->states('sound')->raw();
});

$factory->define(App\Models\Collections\Text::class, function (Faker\Generator $faker) {
    return factory( App\Models\Collections\Asset::class )->states('text')->raw();
});

$factory->define(App\Models\Collections\Video::class, function (Faker\Generator $faker) {
    return factory( App\Models\Collections\Asset::class )->states('video')->raw();
});
