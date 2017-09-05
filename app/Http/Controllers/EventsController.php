<?php

namespace App\Http\Controllers;

class EventsController extends ApiController
{

    protected $model = \App\Models\Membership\Event::class;

    protected $transformer = \App\Http\Transformers\EventTransformer::class;

}
