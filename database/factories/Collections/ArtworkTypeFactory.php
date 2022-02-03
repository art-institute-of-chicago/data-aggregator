<?php

namespace Database\Factories\Collections;

use App\Models\Collections\ArtworkType;

class ArtworkTypeFactory extends CollectionsFactory
{
    protected $model = ArtworkType::class;

    public function definition()
    {
        return $this->idsAndTitle($this->faker->randomElement(['Painting', 'Design', 'Drawing and ' . ucfirst($this->faker->word), ucfirst($this->faker->word) . ' Arts', 'Sculpture']), true, 2);
    }
}
