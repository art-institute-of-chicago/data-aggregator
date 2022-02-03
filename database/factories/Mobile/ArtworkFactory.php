<?php

namespace Database\Factories\Mobile;

use App\Models\Mobile\Artwork;

class ArtworkFactory extends MobileFactory
{
    protected $model = Artwork::class;

    public function definition()
    {
        static $artworks;

        if (!$artworks) {
            $artworks = App\Models\Collections\Artwork::query()->pluck('citi_id')->all();
        }

        return array_merge(
            $this->mobileAppIdsAndTitle(),
            [
                'artwork_citi_id' => $this->faker->randomElement($artworks),
                'latitude' => $this->faker->latitude,
                'longitude' => $this->faker->longitude,
            ]
        );
    }
}
