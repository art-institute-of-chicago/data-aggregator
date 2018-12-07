<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class ProductsController extends BaseController
{

    protected $model = \App\Models\Shop\Product::class;

    protected $transformer = \App\Http\Transformers\ProductTransformer::class;

}
