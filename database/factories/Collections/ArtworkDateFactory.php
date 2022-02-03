<?php

namespace Database\Factories\Collections;

use App\Models\Collections\ArtworkDate;

class ArtworkDateFactory extends CollectionsFactory
{
    protected $model = ArtworkDate::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle($this->faker->word . ' date', true),
            [
                'artwork_citi_id' => $this->faker->randomElement(App\Models\Collections\Artwork::query()->pluck('citi_id')->all()),
                'date_earliest' => $this->faker->dateTimeAd,
                'date_latest' => $this->faker->dateTimeAd,
                'artwork_date_qualifier_citi_id' => $this->faker->randomElement(App\Models\Collections\ArtworkDateQualifier::query()->pluck('citi_id')->all()),
                'preferred' => $this->faker->boolean,
            ]
        );
    }
}
