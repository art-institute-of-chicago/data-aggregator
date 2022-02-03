<?php

namespace Database\Factories\Collections;

use App\Models\Collections\ArtworkPlaceQualifier;

class ArtworkPlaceQualifierFactory extends CollectionsFactory
{
    protected $model = ArtworkPlaceQualifier::class;

    public function definition()
    {
        return $this->idsAndTitle('Object ' . $this->faker->word(1) . ' in', true, 2);
    }
}
