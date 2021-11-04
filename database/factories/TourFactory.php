<?php

namespace Database\Factories;

class TourFactory extends MobileFactory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
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
    }
}

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
