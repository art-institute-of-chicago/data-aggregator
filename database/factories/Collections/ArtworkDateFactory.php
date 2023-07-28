<?php

namespace Database\Factories\Collections;

class ArtworkDateFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\ArtworkDate::class;

    public function definition(): array
    {
        return array_merge(
            $this->idsAndTitle(fake()->word . ' date', true),
            [
                'artwork_id' => fake()->randomElement(App\Models\Collections\Artwork::query()->pluck('id')->all()),
                'date_earliest' => fake()->dateTimeAd,
                'date_latest' => fake()->dateTimeAd,
                'artwork_date_qualifier_id' => fake()->randomElement(App\Models\Collections\ArtworkDateQualifier::query()->pluck('id')->all()),
                'is_preferred' => fake()->boolean,
            ]
        );
    }
}
