<?php

namespace Database\Factories\Collections;

class ImageFactory extends AssetFactory
{
    protected $model = \App\Models\Collections\Image::class;

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
