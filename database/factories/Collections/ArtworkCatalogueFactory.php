<?php

namespace Database\Factories\Collections;

class ArtworkCatalogueFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\ArtworkCatalogue::class;

    public function definition()
    {
        return [
            'artwork_id' => $this->faker->randomElement(App\Models\Collections\Artwork::query()->pluck('id')->all()),
            'is_preferred' => $this->faker->boolean,
            'number' => $this->faker->randomNumber(2),
            'state_edition' => $this->faker->words(2, true),
        ];
    }
}
