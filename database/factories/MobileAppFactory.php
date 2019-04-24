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
            'mobile_id' => $faker->unique()->randomNumber(4) + 999 * pow(10, 4),
            'title' => $title ? $title : ucfirst($faker->words(3, true)),
        ];

    }

}


$factory->define(App\Models\Mobile\Artwork::class, function (Faker\Generator $faker) {
    static $artworks;

    if (!$artworks)
    {
        $artworks = App\Models\Collections\Artwork::fake()->pluck('citi_id')->all();
    }

    return array_merge(
        mobileAppIdsAndTitle($faker),
        [
            'artwork_citi_id' => $faker->randomElement($artworks),
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
        ]
    );
});

$factory->define(App\Models\Mobile\Sound::class, function (Faker\Generator $faker) {
    return array_merge(
        mobileAppIdsAndTitle($faker),
        [
            'link' => $faker->url,
            'transcript' => $faker->paragraph(3),
        ]
    );
});

$factory->define(App\Models\Mobile\Tour::class, function (Faker\Generator $faker) {
    return array_merge(
        mobileAppIdsAndTitle($faker),
        [
            'image' => $faker->imageUrl(),
            'description' => $faker->paragraph(5),
            'intro_text' => $faker->paragraph(3),
            'intro_mobile_id' => $faker->randomElement(App\Models\Mobile\Sound::fake()->pluck('mobile_id')->all()),
            'weight' => $faker->randomDigit,
        ]
    );
});

$factory->define(App\Models\Mobile\TourStop::class, function (Faker\Generator $faker) {
    static $artworks;

    if (!$artworks)
    {
        $artworks = App\Models\Collections\Artwork::fake()->pluck('citi_id')->all();
    }

    return array_merge(
        [
            'tour_mobile_id' => $faker->randomElement(App\Models\Mobile\Sound::fake()->pluck('mobile_id')->all()),
            'mobile_artwork_mobile_id' => $faker->randomElement(App\Models\Mobile\Artwork::fake()->pluck('mobile_id')->all()),
            'mobile_sound_mobile_id' => $faker->randomElement(App\Models\Mobile\Sound::fake()->pluck('mobile_id')->all()),
            'weight' => $faker->randomDigit,
        ]
    );
});

