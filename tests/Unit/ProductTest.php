<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Shop\Product;
use App\Models\Shop\Category;

class ProductTest extends ApiTestCase
{

    protected $model = Product::class;

    protected $route = 'products';

}
