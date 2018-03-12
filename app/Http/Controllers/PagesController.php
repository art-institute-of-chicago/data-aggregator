<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class PagesController extends BaseController
{

    protected $model = \App\Models\Web\Page::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
