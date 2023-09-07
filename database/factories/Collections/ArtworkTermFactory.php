<?php

namespace Database\Factories\Collections;

class ArtworkTermFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\ArtworkTerm::class;

    public function definition(): array
    {
        return [
            'artwork_id' => fake()->randomElement(App\Models\Collections\Artwork::query()->pluck('id')->all()),
            'term_id' => fake()->randomElement(App\Models\Collections\Term::query()->pluck('id')->all()),
            'is_preferred' => fake()->boolean,
        ];
    }
}
