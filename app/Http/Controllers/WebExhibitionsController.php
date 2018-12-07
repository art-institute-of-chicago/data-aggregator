<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class WebExhibitionsController extends BaseController
{

    protected $model = \App\Models\Web\Exhibition::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
