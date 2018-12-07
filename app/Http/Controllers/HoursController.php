<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class HoursController extends BaseController
{

    protected $model = \App\Models\Web\Hour::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
