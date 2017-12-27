<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ShopCategoriesController extends BaseController
{

    protected $model = \App\Models\Shop\Category::class;

    protected $transformer = \App\Http\Transformers\ShopCategoryTransformer::class;

}
