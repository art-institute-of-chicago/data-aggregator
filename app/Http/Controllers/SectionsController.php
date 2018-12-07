<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class SectionsController extends BaseController
{

    protected $model = \App\Models\Dsc\Section::class;

    protected $transformer = \App\Http\Transformers\DscTransformer::class;

}
