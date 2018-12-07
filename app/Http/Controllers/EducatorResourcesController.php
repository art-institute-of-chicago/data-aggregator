<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class EducatorResourcesController extends BaseController
{

    protected $model = \App\Models\Web\EducatorResource::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
