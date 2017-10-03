<?php

namespace Modules\Membership\Http\Controllers;

use App\Http\Controllers\ApiController;

class EventsController extends ApiController
{

    protected $model = \Modules\Membership\Models\Event::class;

    protected $transformer = \Modules\Membership\Http\Transformers\EventTransformer::class;

}
