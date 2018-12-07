<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class MobileSoundsController extends BaseController
{

    protected $model = \App\Models\Mobile\Sound::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
