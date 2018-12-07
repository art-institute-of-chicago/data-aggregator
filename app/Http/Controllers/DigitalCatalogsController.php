<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class DigitalCatalogsController extends BaseController
{

    protected $model = \App\Models\Web\DigitalCatalog::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
