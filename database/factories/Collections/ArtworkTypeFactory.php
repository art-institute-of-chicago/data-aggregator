<?php

namespace Database\Factories\Collections;

use App\Models\Collections\ArtworkType;

class ArtworkTypeFactory extends CollectionsFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = ArtworkType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return $this->idsAndTitle($this->faker->randomElement(['Painting', 'Design', 'Drawing and ' . ucfirst($this->faker->word), ucfirst($this->faker->word) . ' Arts', 'Sculpture']), true, 2);
    }
}
