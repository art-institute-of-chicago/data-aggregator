<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class TagsController extends BaseController
{

    protected $model = \App\Models\Web\Tag::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
