<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class PressReleasesController extends BaseController
{

    protected $model = \App\Models\Web\PressRelease::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
