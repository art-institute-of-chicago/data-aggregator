<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ExhibitionsController extends BaseController
{

    protected $model = \App\Models\Collections\Exhibition::class;

    protected $transformer = \App\Http\Transformers\ExhibitionTransformer::class;

}
