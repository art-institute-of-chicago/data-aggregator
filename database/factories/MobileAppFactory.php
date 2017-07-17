<?php

/*
|--------------------------------------------------------------------------
| Mobile App Factory
|--------------------------------------------------------------------------
|
| Create models with stub data for all data coming from the Mobile App
| Data Service.
|
*/

if (!function_exists('mobileAppIdsAndTitle'))
{
    function mobileAppIdsAndTitle($faker, $title = '')
    {
    
        return [
            'mobile_id' => $faker->unique()->randomNumber(4),
            'title' => $title ? $title : ucfirst($faker->words(3, true)),
        ];

    }

    function mobileAppDates($faker)
    {
                                                        
        return [
            'source_created_at' => $faker->dateTimeThisYear,
            'source_modified_at' => $faker->dateTimeThisYear,
        ];

    }
                                                    
}


$factory->define(App\Mobile\Artwork::class, function (Faker\Generator $faker) {
    static $artworks;

    if (!$artworks)
    {
        $artworks = App\Collections\Artwork::all()->pluck('citi_id')->all();
    }

    return array_merge(
        mobileAppIdsAndTitle($faker),
        [
            'artwork_citi_id' => $faker->randomElement($artworks),
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'highlighted' => $faker->boolean,
            'selector_number' => $faker->randomNumber(3),
        ],
        mobileAppDates($faker)
    );
});

$factory->define(App\Mobile\Sound::class, function (Faker\Generator $faker) {
    return array_merge(
        mobileAppIdsAndTitle($faker),
        [
            'link' => $faker->url,
            'transcript' => $faker->paragraph(3),
        ],
        mobileAppDates($faker)
    );
});

$factory->define(App\Mobile\Tour::class, function (Faker\Generator $faker) {
    return array_merge(
        mobileAppIdsAndTitle($faker),
        [
            'image' => $faker->imageUrl(),
            'description' => $faker->paragraph(5),
            'intro_text' => $faker->paragraph(3),
            'intro_mobile_id' => $faker->randomElement(App\Mobile\Sound::all()->pluck('mobile_id')->all()),
            'weight' => $faker->randomDigit,
        ],
        mobileAppDates($faker)
    );
});

$factory->define(App\Mobile\TourStop::class, function (Faker\Generator $faker) {
    static $artworks;

    if (!$artworks)
    {
        $artworks = App\Collections\Artwork::all()->pluck('citi_id')->all();
    }

    return array_merge(
        [
            'tour_mobile_id' => $faker->randomElement(App\Mobile\Sound::all()->pluck('mobile_id')->all()),
            'artwork_citi_id' => $faker->randomElement($artworks),
            'sound_mobile_id' => $faker->randomElement(App\Mobile\Sound::all()->pluck('mobile_id')->all()),
            'weight' => $faker->randomDigit,
            'description' => $faker->paragraph(5),
        ]
    );
});

