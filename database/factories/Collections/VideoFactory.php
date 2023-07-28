<?php

namespace Database\Factories\Collections;

class VideoFactory extends AssetFactory
{
    protected $model = \App\Models\Collections\Video::class;

    public function definition(): array
    {
        return array_merge(
            parent::definition(),
            [
                'type' => 'video',
            ]
        );
    }
}
