<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ArchivalImagesController extends BaseController
{

    protected $model = \App\Models\Archive\ArchivalImage::class;

    protected $transformer = \App\Http\Transformers\ArchivalImageTransformer::class;

}