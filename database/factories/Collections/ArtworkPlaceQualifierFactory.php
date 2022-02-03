<?php

namespace Database\Factories\Collections;

class ArtworkPlaceQualifierFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\ArtworkPlaceQualifier::class;

    public function definition()
    {
        return $this->idsAndTitle('Object ' . $this->faker->word(1) . ' in', true, 2);
    }
}
