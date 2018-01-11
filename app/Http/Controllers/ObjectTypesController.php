<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ObjectTypesController extends BaseController
{

    protected $model = \App\Models\Collections\ObjectType::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

}
