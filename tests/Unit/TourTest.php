<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Mobile\Tour;
use App\Mobile\Sound;

class TourTest extends ApiTestCase
{

    public function setUp()
    {

        parent::setUp();
        $this->make(Sound::class);

    }

    /** @test */
    public function it_fetches_all_tours()
    {

        $resources = $this->it_fetches_all(Tour::class, 'tours');

    }

    /** @test */
    public function it_fetches_a_single_tour()
    {

        $resource = $this->it_fetches_a_single(Tour::class, 'tours');

    }

    /** @test */
    public function it_fetches_multiple_tours()
    {

        $resources = $this->it_fetches_multiple(Tour::class, 'tours');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Tour::class, 'tours');

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Tour::class, 'tours');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Tour::class, 'tours', true);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Tour::class, 'tours');

    }

}
