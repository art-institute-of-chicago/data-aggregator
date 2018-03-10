<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class WebExhibitionsController extends BaseController
{

    protected $model = \App\Models\Web\Exhibition::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
