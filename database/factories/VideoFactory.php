<?php

namespace Database\Factories;

class VideoFactory extends AssetFactory
{
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
                'type' => 'video',
            ]
        );
    }
}
