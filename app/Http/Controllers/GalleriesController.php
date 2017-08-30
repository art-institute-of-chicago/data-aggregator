<?php

namespace App\Http\Controllers;

class GalleriesController extends ApiNewController
{

    protected $model = \App\Models\Collections\Gallery::class;

    protected $transformer = \App\Http\Transformers\GalleryTransformer::class;

}
