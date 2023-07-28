<?php

namespace Database\Factories\Collections;

class PlaceFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Place::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle(fake()->country, true),
            [
                'latitude' => fake()->latitude,
                'longitude' => fake()->longitude,
            ],
            $this->dates(true)
        );
    }
}
