<?php

namespace Database\Factories\Collections;

class GalleryFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Gallery::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle(fake()->randomElement(['Gallery ' . fake()->unique()->randomNumber(3), fake()->lastName . ' ' . fake()->randomElement(['Hall', 'Building', 'Memorial Garden', 'Reading Room', 'Study Room'])]), true, 6),
            [
                'is_closed' => fake()->boolean(25),
                'number' => fake()->randomNumber(3) . (fake()->boolean(25) ? 'A' : ''),
                'floor' => fake()->randomElement([1, 2, 3, 'LL']),
                'latitude' => fake()->latitude,
                'longitude' => fake()->longitude,
            ],
            $this->dates(true)
        );
    }
}
