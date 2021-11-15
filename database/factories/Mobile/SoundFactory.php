<?php

namespace Database\Factories\Mobile;

use App\Models\Mobile\Sound;

class SoundFactory extends MobileFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Sound::class;

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
                'web_url' => $this->faker->url,
                'transcript' => $this->faker->paragraph(3),
            ]
        );
    }
}
