<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Sound;

class SoundFactory extends AssetFactory
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
            parent::definition(),
            [
                'type' => 'image',
            ]
        );
    }
}
