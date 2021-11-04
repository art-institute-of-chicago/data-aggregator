<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Place;

class PlaceFactory extends CollectionsFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Place::class;

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
