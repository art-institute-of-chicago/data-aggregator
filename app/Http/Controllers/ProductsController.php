<?php

namespace App\Http\Controllers;

class ProductsController extends ApiNewController
{

    protected $model = \App\Models\Shop\Product::class;

    protected $transformer = \App\Http\Transformers\ProductTransformer::class;

}
