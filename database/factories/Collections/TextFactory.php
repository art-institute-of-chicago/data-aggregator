<?php

namespace Database\Factories\Collections;

class TextFactory extends AssetFactory
{
    protected $model = \App\Models\Collections\Text::class;

    public function definition(): array
    {
        return array_merge(
            parent::definition(),
            [
                'type' => 'text',
            ]
        );
    }
}
