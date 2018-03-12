<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class EventsController extends BaseController
{

    protected $model = \App\Models\Web\Event::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
