<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class ArtworkCataloguesController extends BaseController
{

    protected $model = \App\Models\Collections\ArtworkCatalogue::class;

    protected $transformer = \App\Http\Transformers\PivotTransformer::class;

}
