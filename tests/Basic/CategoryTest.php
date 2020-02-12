<?php

namespace Tests\Basic;

use App\Models\Collections\Category;

class CategoryTest extends BasicTestCase
{

    protected $model = Category::class;

    protected function getRandomId()
    {
        return app('Faker')->unique()->regexify('[A-Z]{2}') . '-' . app('Faker')->unique()->randomNumber(5);
    }

}
