<?php

namespace Database\Factories\Collections;

class ArtworkTermFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\ArtworkTerm::class;

    public function definition()
    {
        return [
            'artwork_id' => $this->faker->randomElement(App\Models\Collections\Artwork::query()->pluck('id')->all()),
            'term_lake_uid' => $this->faker->randomElement(App\Models\Collections\Term::query()->pluck('lake_uid')->all()),
            'preferred' => $this->faker->boolean,
        ];
    }
}
