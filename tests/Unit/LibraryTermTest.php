<?php

namespace Tests\Unit;

use App\Models\Library\Term;

class LibraryTermTest extends ApiTestCase
{

    protected $model = Term::class;

    protected function getRandomId()
    {
        return 'zz' .app('Faker')->unique()->randomNumber(5);
    }

}
