<?php

namespace Database\Factories\Collections;

class SoundFactory extends AssetFactory
{
    protected $model = \App\Models\Collections\Sound::class;

    public function definition()
    {
        return array_merge(
            parent::definition(),
            [
                'type' => 'image',
            ]
        );
    }
}
