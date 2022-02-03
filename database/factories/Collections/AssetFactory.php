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
                'lake_guid' => '99999999-9999-9999-9999-999999' . $this->faker->randomNumber(6, true),
                'content' => $this->faker->url,
                'published' => true,
                'description' => $this->faker->paragraph(3),
                'alt_text' => $this->faker->paragraph(3),
                'source_created_at' => $this->faker->dateTimeThisYear,
                'source_indexed_at' => $this->faker->dateTimeThisYear,
            ],
            $this->dates($this->faker)
        );
    }
}
