<?php

namespace Database\Factories\Collections;

class AssetFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Asset::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle(ucwords(fake()->words(3, true))),
            [
                'id' => fake()->uuid(),
                'content' => fake()->url,
                'alt_text' => fake()->paragraph(3),
                'is_multimedia_resource' => false,
                'is_educational_resource' => false,
                'is_teacher_resource' => false,
            ],
            $this->dates(fake())
        );
    }
}
