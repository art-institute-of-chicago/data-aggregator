<?php

namespace Database\Factories\Collections;

class ArtworkDateQualifierFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\ArtworkDateQualifier::class;

    public function definition(): array
    {
        return $this->idsAndTitle(fake()->randomElement(['Made', 'Designed', 'Reconstructed']), true, 2);
    }
}
