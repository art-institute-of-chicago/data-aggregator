<?php

namespace App\Http\Controllers;

class TourStopsController extends ApiNewController
{

    protected $model = \App\Models\Mobile\TourStop::class;

    protected $transformer = \App\Http\Transformers\TourStopTransformer::class;

}
