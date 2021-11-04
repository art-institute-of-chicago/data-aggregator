<?php

namespace Database\Factories;

class TourStopFactory extends MobileFactory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
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
    }
}
