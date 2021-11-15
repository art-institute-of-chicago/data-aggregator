<?php

namespace Database\Factories\Mobile;

use App\Models\Mobile\Tour;
use App\Models\Mobile\Sound;

class TourFactory extends MobileFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Tour::class;

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
                'intro_mobile_id' => $this->faker->randomElement(Sound::query()->pluck('mobile_id')->all()),
                'weight' => $this->faker->randomDigit,
            ]
        );
    }
}
