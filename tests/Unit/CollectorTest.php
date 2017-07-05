<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Dsc\Collector;
use App\Dsc\Publication;

class CollectorTest extends ApiTestCase
{

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);

    }

    /** @test */
    public function it_fetches_all_collectors()
    {

        $this->it_fetches_all(Collector::class, 'collectors');
        
    }

    /** @test */
    public function it_fetches_a_single_collector()
    {

        $this->it_fetches_a_single(Collector::class, 'collectors');

    }

    /** @test */
    public function it_fetches_multiple_collectors()
    {

        $this->it_fetches_multiple(Collector::class, 'collectors');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Collector::class, 'collectors');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Collector::class, 'collectors');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Collector::class, 'collectors');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Collector::class, 'collectors');
        
    }

}
