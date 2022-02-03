<?php

namespace Database\Factories\Mobile;

use App\Models\Mobile\Sound;

class SoundFactory extends MobileFactory
{
    protected $model = Sound::class;

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
