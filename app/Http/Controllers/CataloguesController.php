<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

use Aic\Hub\Foundation\AbstractController as BaseController;

class CataloguesController extends BaseController
{

    protected $model = \App\Models\Collections\Catalogue::class;

    protected $transformer = \App\Http\Transformers\CatalogueTransformer::class;

}
