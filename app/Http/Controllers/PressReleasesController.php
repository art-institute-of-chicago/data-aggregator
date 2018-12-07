<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class PressReleasesController extends BaseController
{

    protected $model = \App\Models\Web\PressRelease::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
