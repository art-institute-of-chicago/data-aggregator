<?php

namespace Tests\Basic;

use App\Models\Library\Term;

class LibraryTermTest extends BasicTestCase
{

    protected $model = Term::class;

    protected function getRandomId()
    {
        return 'zz' . app('Faker')->unique()->randomNumber(5);
    }

}
