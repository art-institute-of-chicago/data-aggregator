<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Category;

class CategoryFactory extends CollectionsFactory
{
    protected $model = Category::class;

    public function definition()
    {
        return array_merge(
            $this->idsAndTitle(ucfirst($this->faker->word(3, true))),
            [
                'is_category' => true,
                'id' => 'PC-' . $this->faker->unique()->randomNumber(6),
                'subtype' => $this->faker->randomElement(['CT-1', 'CT-3']),
                'parent_id' => $this->faker->randomElement(Category::query()->pluck('id')->all()),
            ]
        );
    }
}
