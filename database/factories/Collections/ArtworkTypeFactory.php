<?php

namespace Database\Factories\Collections;

class ArtworkTypeFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\ArtworkType::class;

    public function definition()
    {
        return $this->idsAndTitle($this->faker->randomElement(['Painting', 'Design', 'Drawing and ' . ucfirst($this->faker->word), ucfirst($this->faker->word) . ' Arts', 'Sculpture']), true, 2);
    }
}
