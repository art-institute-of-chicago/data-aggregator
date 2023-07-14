<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Gallery;

class ExhibitionFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Exhibition::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle(ucwords(fake()->words(3, true)), true),
            [
                'gallery_id' => fake()->randomElement(Gallery::query()->pluck('id')->all()),
                'status' => fake()->randomElement(['Open', 'Closed']),
                'date_aic_start' => fake()->dateTimeAd,
                'date_aic_end' => fake()->dateTimeAd,
            ],
            $this->dates(true)
        );
    }
}
