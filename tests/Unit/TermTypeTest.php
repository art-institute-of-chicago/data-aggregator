<?php

namespace Tests\Unit;

use App\Models\Collections\TermType;

class TermTypeTest extends ApiTestCase
{

    protected $model = TermType::class;

    protected $keys = ['lake_guid'];

    protected function getRandomId()
    {
        return app('Faker')->unique()->regexify('[A-Z]{2}') .'-' .app('Faker')->unique()->randomNumber(5);
    }

}
