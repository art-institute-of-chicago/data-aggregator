<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class EventOccurrencesController extends BaseController
{

    protected $model = \App\Models\Web\EventOccurrence::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
