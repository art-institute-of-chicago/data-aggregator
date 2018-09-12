<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class EventOccurrencesController extends BaseController
{

    protected $model = \App\Models\Web\EventOccurrence::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
