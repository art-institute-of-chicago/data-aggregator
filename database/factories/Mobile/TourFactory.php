<?php

namespace Database\Factories\Mobile;

use App\Models\Mobile\Sound;

class TourFactory extends MobileFactory
{
    protected $model = \App\Models\Mobile\Tour::class;

    public function definition()
    {
        return array_merge(
            $this->mobileAppIdsAndTitle(),
            [
                'image' => $this->faker->imageUrl(),
                'description' => $this->faker->paragraph(5),
                'intro_text' => $this->faker->paragraph(3),
                'intro_mobile_id' => $this->faker->randomElement(Sound::query()->pluck('mobile_id')->all()),
                'weight' => $this->faker->randomDigit,
            ]
        );
    }
}
