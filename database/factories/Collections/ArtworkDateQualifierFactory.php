<?php

namespace Database\Factories\Collections;

use App\Models\Collections\ArtworkDateQualifier;

class ArtworkDateQualifierFactory extends CollectionsFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = ArtworkDateQualifier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return $this->idsAndTitle($this->faker->randomElement(['Made', 'Designed', 'Reconstructed', 'Published']), true, 2);
    }
}
