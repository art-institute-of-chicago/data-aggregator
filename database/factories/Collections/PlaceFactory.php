<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Place;

class PlaceFactory extends CollectionsFactory
{
    protected $model = Place::class;

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
