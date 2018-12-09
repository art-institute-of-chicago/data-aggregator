<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class ArtworksController extends BaseController
{

    protected $model = \App\Models\Collections\Artwork::class;

    protected $transformer = \App\Http\Transformers\ArtworkTransformer::class;

}
