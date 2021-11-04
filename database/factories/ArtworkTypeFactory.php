<?php

namespace Database\Factories;

class ArtworkTypeFactory extends CollectionsFactory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return $this->idsAndTitle($this->faker->randomElement(['Painting', 'Design', 'Drawing and ' . ucfirst($this->faker->word), ucfirst($this->faker->word) . ' Arts', 'Sculpture']), true, 2);
    }
}
