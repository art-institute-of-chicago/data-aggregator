<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Text;

class TextFactory extends AssetFactory
{
    protected $model = Text::class;

    public function definition()
    {
        return array_merge(
            parent::definition(),
            [
                'type' => 'text',
            ]
        );
    }
}
