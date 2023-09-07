<?php

namespace Database\Factories\Mobile;

class SoundFactory extends MobileFactory
{
    protected $model = \App\Models\Mobile\Sound::class;

    public function definition(): array
    {
        return array_merge(
            $this->mobileAppIdsAndTitle(),
            [
                'web_url' => fake()->url,
                'transcript' => fake()->paragraph(3),
            ]
        );
    }
}
