<?php

namespace Database\Factories\Collections;

class PlaceFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Place::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle($this->faker->country, true),
            [
                'latitude' => $this->faker->latitude,
                'longitude' => $this->faker->longitude,
            ],
            $this->dates(true)
        );
    }
}
