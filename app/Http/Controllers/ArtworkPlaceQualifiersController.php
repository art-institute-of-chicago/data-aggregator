<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class ArtworkPlaceQualifiersController extends BaseController
{

    protected $model = \App\Models\Collections\ArtworkPlaceQualifier::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

}
