<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ArticlesController extends BaseController
{

    protected $model = \App\Models\Web\Article::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
