<?php

namespace Database\Factories;

class ArtworkCatalogueFactory extends CollectionsFactory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
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
