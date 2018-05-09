<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class PrintedCatalogsController extends BaseController
{

    protected $model = \App\Models\Web\PrintedCatalog::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
