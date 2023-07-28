<?php

namespace Tests\Basic;

use App\Models\Collections\Category;

class CategoryTest extends BasicTestCase
{
    protected $model = Category::class;

    protected function getRandomId()
    {
        return fake()->unique()->regexify('[A-Z]{2}') . '-' . fake()->unique()->randomNumber(5);
    }
}
