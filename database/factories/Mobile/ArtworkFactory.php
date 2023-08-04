<?php

namespace Database\Factories\Mobile;

class ArtworkFactory extends MobileFactory
{
    protected $model = \App\Models\Mobile\Artwork::class;

    public function definition(): array
    {
        static $artworks;

        if (!$artworks) {
            $artworks = \App\Models\Collections\Artwork::query()->pluck('id')->all();
        }

        return array_merge(
            $this->mobileAppIdsAndTitle(),
            [
                'artwork_id' => fake()->randomElement($artworks),
                'latitude' => fake()->latitude,
                'longitude' => fake()->longitude,
            ]
        );
    }
}
