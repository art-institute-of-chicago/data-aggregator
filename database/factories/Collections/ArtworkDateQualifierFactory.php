<?php

namespace Database\Factories\Collections;

class ArtworkDateQualifierFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\ArtworkDateQualifier::class;

    public function definition()
    {
        return $this->idsAndTitle($this->faker->randomElement(['Made', 'Designed', 'Reconstructed', 'Published']), true, 2);
    }
}
