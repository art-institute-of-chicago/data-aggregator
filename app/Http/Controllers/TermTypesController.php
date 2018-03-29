<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class TermTypesController extends BaseController
{

    protected $model = \App\Models\Collections\TermType::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

}
