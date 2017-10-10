<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Collections\Category;

class CategoryTest extends ApiTestCase
{

    protected $model = Category::class;

    protected $route = 'categories';

}
