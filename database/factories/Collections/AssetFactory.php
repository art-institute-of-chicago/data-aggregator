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
                'alt_text' => $this->faker->paragraph(3),
            ],
            $this->dates($this->faker)
        );
    }
}
