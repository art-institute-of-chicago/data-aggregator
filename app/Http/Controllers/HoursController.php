<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class HoursController extends BaseController
{

    protected $model = \App\Models\Web\Hour::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
