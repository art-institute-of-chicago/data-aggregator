<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ArchiveImagesController extends BaseController
{

    protected $model = \App\Models\Archive\ArchiveImage::class;

    protected $transformer = \App\Http\Transformers\ArchiveImageTransformer::class;

}
