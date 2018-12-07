<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class TicketedEventTypesController extends BaseController
{

    protected $model = \App\Models\Membership\TicketedEventType::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
