<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Video;

class VideoFactory extends AssetFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Video::class;

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
