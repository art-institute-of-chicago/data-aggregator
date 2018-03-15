<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class WebArtistsController extends BaseController
{

    protected $model = \App\Models\Web\Artist::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
