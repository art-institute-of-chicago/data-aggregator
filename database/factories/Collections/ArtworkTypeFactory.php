<?php

namespace Database\Factories\Collections;

class ArtworkTypeFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\ArtworkType::class;

    public function definition()
    {
        return $this->idsAndTitle(fake()->randomElement(['Painting', 'Design', 'Drawing and ' . ucfirst(fake()->word), ucfirst(fake()->word) . ' Arts', 'Sculpture']), true, 2);
    }
}
