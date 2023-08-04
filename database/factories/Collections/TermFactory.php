<?php

namespace Database\Factories\Collections;

class TermFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Term::class;

    public function definition(): array
    {
        return array_merge(
            $this->idsAndTitle(ucfirst(fake()->word(3, true))),
            [
                'is_category' => false,
                'id' => 'TM-' . fake()->unique()->randomNumber(6),
                'subtype' => fake()->randomElement(['TT-1', 'TT-2', 'TT-3', 'TT-4', 'TT-5']),
            ]
        );
    }
}
