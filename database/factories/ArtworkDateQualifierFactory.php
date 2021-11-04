<?php

namespace Database\Factories;

class ArtworkDateQualifierFactory extends CollectionsFactory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return $this->idsAndTitle($this->faker->randomElement(['Made', 'Designed', 'Reconstructed', 'Published']), true, 2);
    }
}
