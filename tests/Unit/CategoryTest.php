<?php

namespace Tests\Unit;

use App\Models\Collections\Category;

class CategoryTest extends ApiTestCase
{

    protected $model = Category::class;

    protected $route = 'categories';
    protected function getRandomId()
    {
        return app('Faker')->unique()->regexify('[A-Z]{2}') .'-' .app('Faker')->unique()->randomNumber(5);
    }

}
