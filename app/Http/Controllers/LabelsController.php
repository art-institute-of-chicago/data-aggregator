<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class LabelsController extends BaseController
{

    protected $model = \App\Models\DigitalLabel\Label::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
