<?php

namespace Tests\Basic;

use App\Models\Web\Event;

class EventTest extends BasicTestCase
{
    protected $model = Event::class;

    protected $route = 'events';
}
