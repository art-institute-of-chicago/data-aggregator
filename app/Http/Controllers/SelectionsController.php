<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class SelectionsController extends BaseController
{

    protected $model = \App\Models\Web\Selection::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
