<?php

namespace Database\Factories\Collections;

use App\Models\Collections\ArtworkDateQualifier;

class ArtworkDateQualifierFactory extends CollectionsFactory
{
    protected $model = ArtworkDateQualifier::class;

    public function definition()
    {
        return $this->idsAndTitle($this->faker->randomElement(['Made', 'Designed', 'Reconstructed', 'Published']), true, 2);
    }
}
