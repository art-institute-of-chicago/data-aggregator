<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MobileFactory extends Factory
{
    public function mobileAppIdsAndTitle($title = '')
    {
        return [
            'mobile_id' => $this->faker->unique()->randomNumber(4) + 999 * pow(10, 4),
            'title' => $title ? $title : ucfirst($this->faker->words(3, true)),
        ];
    }
}

$factory->define(App\Models\Mobile\Artwork::class, function (Faker\Generator $this->faker) {
    static $artworks;

    if (!$artworks) {
        $artworks = App\Models\Collections\Artwork::query()->pluck('citi_id')->all();
    }

    return array_merge(
        $this->mobileAppIdsAndTitle(),
        [
            'artwork_citi_id' => $this->faker->randomElement($artworks),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]
    );
});

$factory->define(App\Models\Mobile\Sound::class, function (Faker\Generator $this->faker) {
    return array_merge(
        $this->mobileAppIdsAndTitle(),
        [
            'web_url' => $this->faker->url,
            'transcript' => $this->faker->paragraph(3),
        ]
    );
});

$factory->define(App\Models\Mobile\Tour::class, function (Faker\Generator $this->faker) {
    return array_merge(
        $this->mobileAppIdsAndTitle(),
        [
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph(5),
            'intro_text' => $this->faker->paragraph(3),
            'intro_mobile_id' => $this->faker->randomElement(App\Models\Mobile\Sound::query()->pluck('mobile_id')->all()),
            'weight' => $this->faker->randomDigit,
        ]
    );
});

$factory->define(App\Models\Mobile\TourStop::class, function (Faker\Generator $this->faker) {
    static $artworks;

    if (!$artworks) {
        $artworks = App\Models\Collections\Artwork::query()->pluck('citi_id')->all();
    }

    return array_merge(
        [
            'id' => $this->faker->unique()->randomNumber(4),
            'tour_mobile_id' => $this->faker->randomElement(App\Models\Mobile\Sound::query()->pluck('mobile_id')->all()),
            'mobile_artwork_mobile_id' => $this->faker->randomElement(App\Models\Mobile\Artwork::query()->pluck('mobile_id')->all()),
            'mobile_sound_mobile_id' => $this->faker->randomElement(App\Models\Mobile\Sound::query()->pluck('mobile_id')->all()),
            'weight' => $this->faker->randomDigit,
        ]
    );
});
