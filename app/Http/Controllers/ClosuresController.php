<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class ClosuresController extends BaseController
{

    protected $model = \App\Models\Web\Closure::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
