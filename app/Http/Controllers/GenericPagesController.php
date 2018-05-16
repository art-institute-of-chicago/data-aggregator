<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class GenericPagesController extends BaseController
{

    protected $model = \App\Models\Web\GenericPage::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
