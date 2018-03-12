<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ClosuresController extends BaseController
{

    protected $model = \App\Models\Web\Closure::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
