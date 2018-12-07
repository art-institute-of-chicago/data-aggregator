<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class PrintedCatalogsController extends BaseController
{

    protected $model = \App\Models\Web\PrintedCatalog::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
