<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Image;

class ImageFactory extends AssetFactory
{
    protected $model = Image::class;

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
