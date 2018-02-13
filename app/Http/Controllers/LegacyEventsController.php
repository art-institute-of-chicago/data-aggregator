<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class LegacyEventsController extends BaseController
{

    protected $model = \App\Models\Membership\LegacyEvent::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
