<?php

namespace Database\Factories\Collections;

class AssetFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Asset::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle(ucwords($this->faker->words(3, true))),
            [
                'id' => $this->faker->uuid(),
                'content' => $this->faker->url,
                'is_published' => true,
                'description' => $this->faker->paragraph(3),
                'alt_text' => $this->faker->paragraph(3),
                'source_indexed_at' => $this->faker->dateTimeThisYear,
            ],
            $this->dates($this->faker)
        );
    }
}
