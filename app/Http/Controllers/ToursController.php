<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ToursController extends BaseController
{

    protected $model = \App\Models\Mobile\Tour::class;

    protected $transformer = \App\Http\Transformers\TourTransformer::class;

}
