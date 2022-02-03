<?php

namespace Database\Factories\Collections;

use App\Models\Collections\ArtworkCatalogue;

class ArtworkCatalogueFactory extends CollectionsFactory
{
    protected $model = ArtworkCatalogue::class;

    public function definition()
    {
        return [
            'artwork_citi_id' => $this->faker->randomElement(App\Models\Collections\Artwork::query()->pluck('citi_id')->all()),
            'preferred' => $this->faker->boolean,
            'number' => $this->faker->randomNumber(2),
            'state_edition' => $this->faker->words(2, true),
        ];
    }
}
