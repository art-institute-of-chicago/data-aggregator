<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class LabelsController extends BaseController
{

    protected $model = \App\Models\DigitalLabel\Label::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
