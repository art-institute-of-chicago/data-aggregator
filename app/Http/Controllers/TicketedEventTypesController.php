<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class TicketedEventTypesController extends BaseController
{

    protected $model = \App\Models\Membership\TicketedEventType::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
