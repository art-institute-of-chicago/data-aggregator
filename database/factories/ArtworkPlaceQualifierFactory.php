<?php

namespace Database\Factories;

class ArtworkPlaceQualifierFactory extends CollectionsFactory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return $this->idsAndTitle('Object ' . $this->faker->word(1) . ' in', true, 2);
    }
}
