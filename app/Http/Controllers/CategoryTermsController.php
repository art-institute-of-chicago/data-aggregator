<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class CategoryTermsController extends BaseController
{

    protected $model = \App\Models\Collections\CategoryTerm::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

}
