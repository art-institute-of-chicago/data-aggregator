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
            'dsc_id' => $id ?: $faker->unique()->randomNumber(4),
            'title' => ucfirst($faker->words(3, true)),
        ];

    }

    function dscDates($faker)
    {
                                                        
        return [
            'source_created_at' => $faker->dateTimeThisYear,
            'source_modified_at' => $faker->dateTimeThisYear,
        ];

    }
                                                    
}


$factory->define(App\Dsc\Publication::class, function (Faker\Generator $faker) {
    return array_merge(
        dscIdsAndTitle($faker),
        [
            'link' => $faker->url,
        ],
        dscDates($faker)
    );
});

$factory->define(App\Dsc\TitlePage::class, function (Faker\Generator $faker) {
    return array_merge(
        dscIdsAndTitle($faker),
        [
            'content' => '<img src="' .$faker->imageUrl .'" />',
            'publication_dsc_id' => $faker->randomElement(App\Dsc\Publication::all()->pluck('dsc_id')->all()),
        ]
    );
});

$factory->define(App\Dsc\Section::class, function (Faker\Generator $faker) {
    return array_merge(
        dscIdsAndTitle($faker),
        [
            'content' => $faker->paragraphs(10, true),
            'publication_dsc_id' => $faker->randomElement(App\Dsc\Publication::all()->pluck('dsc_id')->all()),
            'weight' => $faker->randomNumber(2),
            'depth' => $faker->randomDigit,
        ]
    );
});

$factory->define(App\Dsc\WorkOfArt::class, function (Faker\Generator $faker) {
    return array_merge(
        dscIdsAndTitle($faker),
        [
            'content' => $faker->paragraphs(10, true),
            'publication_dsc_id' => $faker->randomElement(App\Dsc\Publication::all()->pluck('dsc_id')->all()),
            'artwork_citi_id' => $faker->randomElement(App\Collections\Artwork::all()->pluck('citi_id')->all()),
            'weight' => $faker->randomNumber(2),
            'depth' => $faker->randomDigit,
        ]
    );
});

$factory->define(App\Dsc\Footnote::class, function (Faker\Generator $faker) {
    $section_id = $faker->randomElement(App\Dsc\Section::all()->pluck('dsc_id')->all());
    $id = 'fn-' .$section_id .'-' .$faker->randomNumber(3);
    return array_merge(
        dscIdsAndTitle($faker, $id),
        [
            'content' => $faker->paragraph(3),
            'section_dsc_id' => $section_id,
        ]
    );
});

$factory->define(App\Dsc\Figure::class, function (Faker\Generator $faker) {
    $section_id = $faker->randomElement(App\Dsc\Section::all()->pluck('dsc_id')->all());
    $id = 'fig-' .$section_id .'-' .$faker->randomNumber(3);
    return array_merge(
        dscIdsAndTitle($faker, $id),
        [
            'content' => $faker->paragraph(3),
            'section_dsc_id' => $section_id,
        ]
    );
});

$factory->define(App\Dsc\FigureImage::class, function (Faker\Generator $faker) {
    return array_merge(
        [
            'title' => ucfirst($faker->words(3, true)),
            'figure_dsc_id' => $faker->randomElement(App\Dsc\Figure::all()->pluck('dsc_id')->all()),
            'link' => $faker->url,
        ]
    );
});

$factory->define(App\Dsc\FigureVector::class, function (Faker\Generator $faker) {
    return array_merge(
        [
            'title' => ucfirst($faker->words(3, true)),
            'figure_dsc_id' => $faker->randomElement(App\Dsc\Figure::all()->pluck('dsc_id')->all()),
            'link' => $faker->url,
        ]
    );
});


$factory->define(App\Dsc\Collector::class, function (Faker\Generator $faker) {
    return array_merge(
        dscIdsAndTitle($faker),
        [
            'content' => $faker->paragraph(3),
            'publication_dsc_id' => $faker->randomElement(App\Dsc\Publication::all()->pluck('dsc_id')->all()),
            'weight' => $faker->randomNumber(2),
            'depth' => $faker->randomDigit,
        ]
    );
});

