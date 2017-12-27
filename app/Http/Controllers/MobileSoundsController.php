<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class MobileSoundsController extends BaseController
{

    protected $model = \App\Models\Mobile\Sound::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
