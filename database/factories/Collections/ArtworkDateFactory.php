<?php

namespace Database\Factories\Collections;

class ArtworkDateFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\ArtworkDate::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle($this->faker->word . ' date', true),
            [
                'artwork_id' => $this->faker->randomElement(App\Models\Collections\Artwork::query()->pluck('id')->all()),
                'date_earliest' => $this->faker->dateTimeAd,
                'date_latest' => $this->faker->dateTimeAd,
                'artwork_date_qualifier_id' => $this->faker->randomElement(App\Models\Collections\ArtworkDateQualifier::query()->pluck('id')->all()),
                'preferred' => $this->faker->boolean,
            ]
        );
    }
}
