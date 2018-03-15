<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class LocationsController extends BaseController
{

    protected $model = \App\Models\Web\Location::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
