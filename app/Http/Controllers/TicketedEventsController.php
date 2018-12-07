<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class TicketedEventsController extends BaseController
{

    protected $model = \App\Models\Membership\TicketedEvent::class;

    protected $transformer = \App\Http\Transformers\TicketedEventTransformer::class;

}
