<?php

namespace Database\Factories\Mobile;

use App\Models\Mobile\Sound;

class TourFactory extends MobileFactory
{
    protected $model = \App\Models\Mobile\Tour::class;

    public function definition(): array
    {
        return array_merge(
            $this->mobileAppIdsAndTitle(),
            [
                'image' => fake()->imageUrl(),
                'description' => fake()->paragraph(5),
                'intro_text' => fake()->paragraph(3),
                'intro_id' => fake()->randomElement(Sound::query()->pluck('id')->all()),
                'weight' => fake()->randomDigit,
            ]
        );
    }
}
