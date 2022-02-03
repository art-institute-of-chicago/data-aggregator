<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Gallery;

class GalleryFactory extends CollectionsFactory
{
    protected $model = Gallery::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle($this->faker->randomElement(['Gallery ' . $this->faker->unique()->randomNumber(3), $this->faker->lastName . ' ' . $this->faker->randomElement(['Hall', 'Building', 'Memorial Garden', 'Reading Room', 'Study Room'])]), true, 6),
            [
                'is_closed' => $this->faker->boolean(25),
                'number' => $this->faker->randomNumber(3) . ($this->faker->boolean(25) ? 'A' : ''),
                'floor' => $this->faker->randomElement([1, 2, 3, 'LL']),
                'latitude' => $this->faker->latitude,
                'longitude' => $this->faker->longitude,
                'type' => 'AIC Gallery',
            ],
            $this->dates(true)
        );
    }
}
