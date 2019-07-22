<?php

namespace Tests\Unit;

use App\Models\Library\Material;

class LibraryMaterialTest extends ApiTestCase
{

    protected $model = Material::class;

    protected function getRandomId()
    {
        return env('PRIMO_API_SOURCE') . app('Faker')->unique()->randomNumber(5);
    }

}
