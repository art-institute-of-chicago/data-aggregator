<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class PlacesController extends BaseController
{

    protected $model = \App\Models\Collections\Place::class;

    protected $transformer = \App\Http\Transformers\PlaceTransformer::class;

}
