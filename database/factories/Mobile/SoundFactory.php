<?php

namespace Database\Factories\Mobile;

class SoundFactory extends MobileFactory
{
    protected $model = \App\Models\Mobile\Sound::class;

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
