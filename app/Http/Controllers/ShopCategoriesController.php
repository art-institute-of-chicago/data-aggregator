<?php

namespace App\Http\Controllers;

class ShopCategoriesController extends ApiNewController
{

    protected $model = \App\Models\Shop\Category::class;

    protected $transformer = \App\Http\Transformers\ShopCategoryTransformer::class;

}
