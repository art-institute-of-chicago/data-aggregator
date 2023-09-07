<?php

namespace Database\Factories\Collections;

class SoundFactory extends AssetFactory
{
    protected $model = \App\Models\Collections\Sound::class;

    public function definition(): array
    {
        return array_merge(
            parent::definition(),
            [
                'type' => 'image',
            ]
        );
    }
}
