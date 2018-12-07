<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class ArtworkTypesController extends BaseController
{

    protected $model = \App\Models\Collections\ArtworkType::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

}
