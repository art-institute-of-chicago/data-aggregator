<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class ArtworkDateQualifiersController extends BaseController
{

    protected $model = \App\Models\Collections\ArtworkDateQualifier::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

}
