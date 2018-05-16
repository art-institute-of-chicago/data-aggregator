<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ResearchGuidesController extends BaseController
{

    protected $model = \App\Models\Web\ResearchGuide::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
