<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class PublicationsController extends BaseController
{

    protected $model = \App\Models\Dsc\Publication::class;

    protected $transformer = \App\Http\Transformers\DscTransformer::class;

}
