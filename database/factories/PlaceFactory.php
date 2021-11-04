<?php

namespace Database\Factories;

class PlaceFactory extends CollectionsFactory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
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
