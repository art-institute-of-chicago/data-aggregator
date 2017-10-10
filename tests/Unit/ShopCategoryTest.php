<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Shop\Category;

class ShopCategoryTest extends ApiTestCase
{

    protected $model = Category::class;

    protected $route = 'shop-categories';

}
