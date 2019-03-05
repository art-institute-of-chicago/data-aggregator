<?php

namespace Tests\Unit;

use App\Models\Collections\Term;

class TermTest extends ApiTestCase
{

    protected $model = Term::class;

    protected function getRandomId()
    {
        return app('Faker')->unique()->regexify('[A-Z]{2}') .'-' .app('Faker')->unique()->randomNumber(5);
    }

}
