<?php

namespace Tests\Basic;

use App\Models\Collections\CategoryTerm;
use App\Models\Collections\Category;
use App\Models\Collections\Term;

class CategoryTermTest extends BasicTestCase
{
    protected $model = CategoryTerm::class;

    protected $route = 'category-terms';

    public function model()
    {
        if ($this->model === CategoryTerm::class) {
            return random_int(0, 1) ? Category::class : Term::class;
        }

        return parent::model();
    }

    protected function getRandomId()
    {
        return app('Faker')->unique()->regexify('[A-Z]{2}') . '-' . app('Faker')->unique()->randomNumber(5);
    }
}
