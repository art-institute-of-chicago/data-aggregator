<?php

namespace Database\Factories\Collections;

use App\Models\Collections\ArtworkTerm;

class ArtworkTermFactory extends CollectionsFactory
{
    protected $model = ArtworkTerm::class;

    public function definition()
    {
        return [
            'artwork_citi_id' => $this->faker->randomElement(App\Models\Collections\Artwork::query()->pluck('citi_id')->all()),
            'term_lake_uid' => $this->faker->randomElement(App\Models\Collections\Term::query()->pluck('lake_uid')->all()),
            'preferred' => $this->faker->boolean,
        ];
    }
}
