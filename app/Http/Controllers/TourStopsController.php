<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class TourStopsController extends BaseController
{

    protected $model = \App\Models\Mobile\TourStop::class;

    protected $transformer = \App\Http\Transformers\TourStopTransformer::class;

}
