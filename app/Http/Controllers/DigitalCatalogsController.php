<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class DigitalCatalogsController extends BaseController
{

    protected $model = \App\Models\Web\DigitalCatalog::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
