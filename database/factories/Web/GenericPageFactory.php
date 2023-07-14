<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class GenericPageFactory extends Factory
{
    protected $model = \App\Models\Web\GenericPage::class;

    public function definition()
    {
        return [
            'id' => fake()->unique()->randomNumber(4),
            'title' => ucfirst(fake()->words(3, true)),
        ];
    }
}
