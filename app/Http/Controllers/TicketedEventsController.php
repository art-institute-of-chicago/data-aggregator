<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class TicketedEventsController extends BaseController
{

    protected $model = \App\Models\Membership\TicketedEvent::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
