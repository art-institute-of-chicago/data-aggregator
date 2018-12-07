<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class EventsController extends BaseController
{

    protected $model = \App\Models\Web\Event::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
