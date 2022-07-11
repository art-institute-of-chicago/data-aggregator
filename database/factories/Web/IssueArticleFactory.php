<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;

class IssueArticleFactory extends Factory
{
    protected $model = \App\Models\Web\IssueArticle::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4),
            'title' => ucfirst($this->faker->words(3, true)),
        ];
    }
}
