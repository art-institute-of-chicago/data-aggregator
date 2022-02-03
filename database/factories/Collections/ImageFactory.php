<?php

namespace Database\Factories\Collections;

class ImageFactory extends AssetFactory
{
    protected $model = \App\Models\Collections\Image::class;

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
