<?php

namespace Database\Factories\Collections;

use App\Models\Collections\ArtworkPlaceQualifier;

class ArtworkPlaceQualifierFactory extends CollectionsFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = ArtworkPlaceQualifier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return $this->idsAndTitle('Object ' . $this->faker->word(1) . ' in', true, 2);
    }
}
