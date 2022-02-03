<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Place;

class ExhibitionFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Exhibition::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle(ucwords($this->faker->words(3, true)), true),
            [
                'description' => $this->faker->paragraph(3),
                'type' => $this->faker->randomElement(['AIC Only', 'AIC & Other Venues', 'Mini Exhibition', 'Permanent Collection Special Project', 'Rotation']),
                'department_display' => ucwords($this->faker->words(2, true)),
                'place_citi_id' => $this->faker->randomElement(Place::query()->pluck('citi_id')->all()),
                'place_display' => 'Gallery ' . $this->faker->randomNumber(3),
                'status' => $this->faker->randomElement(['Open', 'Closed']),
                'date_aic_start' => $this->faker->dateTimeAd,
                'date_aic_end' => $this->faker->dateTimeAd,
            ],
            $this->dates(true)
        );
    }
}
