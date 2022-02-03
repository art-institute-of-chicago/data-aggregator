<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Sound;

class SoundFactory extends AssetFactory
{
    protected $model = Sound::class;

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
