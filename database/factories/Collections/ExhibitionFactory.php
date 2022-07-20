<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Gallery;

class ExhibitionFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Exhibition::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle(ucwords($this->faker->words(3, true)), true),
            [
                'gallery_id' => $this->faker->randomElement(Gallery::query()->pluck('id')->all()),
                'status' => $this->faker->randomElement(['Open', 'Closed']),
                'date_aic_start' => $this->faker->dateTimeAd,
                'date_aic_end' => $this->faker->dateTimeAd,
            ],
            $this->dates(true)
        );
    }
}
