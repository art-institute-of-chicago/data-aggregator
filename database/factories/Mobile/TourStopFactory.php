<?php

namespace Database\Factories\Mobile;

class TourStopFactory extends MobileFactory
{
    protected $model = \App\Models\Mobile\TourStop::class;

    public function definition()
    {
        static $artworks;

        if (!$artworks) {
            $artworks = App\Models\Collections\Artwork::query()->pluck('id')->all();
        }

        return array_merge(
            [
                'id' => $this->faker->unique()->randomNumber(4),
                'tour_id' => $this->faker->randomElement(App\Models\Mobile\Sound::query()->pluck('id')->all()),
                'mobile_artwork_id' => $this->faker->randomElement(App\Models\Mobile\Artwork::query()->pluck('id')->all()),
                'mobile_sound_id' => $this->faker->randomElement(App\Models\Mobile\Sound::query()->pluck('id')->all()),
                'weight' => $this->faker->randomDigit,
            ]
        );
    }
}
