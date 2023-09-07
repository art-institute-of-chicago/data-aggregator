<?php

namespace Database\Factories\Collections;

class ArtworkPlaceQualifierFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\ArtworkPlaceQualifier::class;

    public function definition(): array
    {
        return $this->idsAndTitle('Object ' . fake()->word(1) . ' in', true, 2);
    }
}
