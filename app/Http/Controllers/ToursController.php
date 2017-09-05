<?php

namespace App\Http\Controllers;

class ToursController extends ApiController
{

    protected $model = \App\Models\Mobile\Tour::class;

    protected $transformer = \App\Http\Transformers\TourTransformer::class;

}
