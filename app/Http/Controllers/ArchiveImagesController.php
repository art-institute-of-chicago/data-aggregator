<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class ArchiveImagesController extends BaseController
{

    protected $model = \App\Models\Archive\ArchiveImage::class;

    protected $transformer = \App\Http\Transformers\ArchiveImageTransformer::class;

}
