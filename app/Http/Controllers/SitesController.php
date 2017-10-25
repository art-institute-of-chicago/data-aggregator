<?php

namespace App\Http\Controllers;

class SitesController extends ApiController
{

    protected $model = \App\Models\StaticArchive\Site::class;

    protected $transformer = \App\Http\Transformers\SiteTransformer::class;

}
