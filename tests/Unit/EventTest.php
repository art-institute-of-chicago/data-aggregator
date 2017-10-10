<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Membership\Event;

class EventTest extends ApiTestCase
{

    protected $model = Event::class;

    protected $route = 'events';

}
