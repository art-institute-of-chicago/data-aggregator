<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class ExhibitionsController extends BaseController
{

    protected $model = \App\Models\Collections\Exhibition::class;

    protected $transformer = \App\Http\Transformers\ExhibitionTransformer::class;

}
