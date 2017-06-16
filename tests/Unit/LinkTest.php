<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Link;

use Tests\Helpers\Factory;

class LinkTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_links()
    {

        $this->it_fetches_all(Link::class, 'links');
        
    }

    /** @test */
    public function it_fetches_a_single_link()
    {

        $this->it_fetches_a_single(Link::class, 'links');

    }

    /** @test */
    public function it_fetches_multiple_links()
    {

        $this->it_fetches_multiple(Link::class, 'links');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Link::class, 'links');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Link::class, 'links');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Link::class, 'links');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Link::class, 'links');
        
    }
    
}
