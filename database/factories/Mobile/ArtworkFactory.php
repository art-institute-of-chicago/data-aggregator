<?php

namespace Database\Factories\Mobile;

use App\Models\Mobile\Artwork;

class ArtworkFactory extends MobileFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Artwork::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
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
