<?php

namespace Database\Factories;

class ArtworkTermFactory extends CollectionsFactory
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
            'term_lake_uid' => $this->faker->randomElement(App\Models\Collections\Term::query()->pluck('lake_uid')->all()),
            'preferred' => $this->faker->boolean,
        ];
    }
}
