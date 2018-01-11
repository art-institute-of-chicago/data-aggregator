<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ProductsController extends BaseController
{

    protected $model = \App\Models\Shop\Product::class;

    protected $transformer = \App\Http\Transformers\ProductTransformer::class;

}
