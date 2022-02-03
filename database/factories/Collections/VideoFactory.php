<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Video;

class VideoFactory extends AssetFactory
{
    protected $model = Video::class;

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
