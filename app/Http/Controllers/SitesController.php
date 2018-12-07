<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class SitesController extends BaseController
{

    protected $model = \App\Models\StaticArchive\Site::class;

    protected $transformer = \App\Http\Transformers\SiteTransformer::class;

}
