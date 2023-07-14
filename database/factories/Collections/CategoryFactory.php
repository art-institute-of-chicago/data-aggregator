<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Category;

class CategoryFactory extends CollectionsFactory
{
    protected $model = Category::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle(ucfirst(fake()->word(3, true))),
            [
                'is_category' => true,
                'id' => 'PC-' . fake()->unique()->randomNumber(6),
                'subtype' => fake()->randomElement(['CT-1', 'CT-3']),
                'parent_id' => fake()->randomElement(Category::query()->pluck('id')->all()),
            ]
        );
    }
}
