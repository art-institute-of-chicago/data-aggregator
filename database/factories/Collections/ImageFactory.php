<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Image;

class ImageFactory extends AssetFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Image::class;

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
