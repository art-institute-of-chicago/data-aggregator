<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Category;

class CategoryFactory extends CollectionsFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return array_merge(
            $this->idsAndTitle(ucfirst($this->faker->word(3, true))),
            [
                'is_category' => true,
                'lake_uid' => 'PC-' . ($this->faker->unique()->randomNumber(6) + 999 * pow(10, 6)),
                'subtype' => $this->faker->randomElement(['CT-1', 'CT-3']),
                'parent_id' => $this->faker->randomElement(Category::query()->pluck('lake_uid')->all()),
            ]
        );
    }
}
