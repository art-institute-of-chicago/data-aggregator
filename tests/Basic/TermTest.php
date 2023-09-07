<?php

namespace Tests\Basic;

use App\Models\Collections\Term;

class TermTest extends BasicTestCase
{
    protected $model = Term::class;

    protected function getRandomId()
    {
        return fake()->unique()->regexify('[A-Z]{2}') . '-' . fake()->unique()->randomNumber(5);
    }
}
