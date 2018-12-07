<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class SelectionsController extends BaseController
{

    protected $model = \App\Models\Web\Selection::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
