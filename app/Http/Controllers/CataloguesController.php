<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class CataloguesController extends BaseController
{

    protected $model = \App\Models\Collections\Catalogue::class;

    protected $transformer = \App\Http\Transformers\CatalogueTransformer::class;

}
