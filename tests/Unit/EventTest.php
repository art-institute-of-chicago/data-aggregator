<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Membership\Event;

class EventTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_all_events()
    {

        $this->it_fetches_all(Event::class, 'events');

    }

    /** @test */
    public function it_fetches_a_single_event()
    {

        $this->it_fetches_a_single(Event::class, 'events');

    }

    /** @test */
    public function it_fetches_multiple_events()
    {

        $this->it_fetches_multiple(Event::class, 'events');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Event::class, 'events');

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Event::class, 'events');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Event::class, 'events');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Event::class, 'events');

    }

}
