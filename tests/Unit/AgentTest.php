<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Agent;

class AgentTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_all_agents()
    {

        $this->it_fetches_all(Agent::class, 'agents');
        
    }

    /** @test */
    public function it_fetches_a_single_agent()
    {

        $this->it_fetches_a_single(Agent::class, 'agents');

    }

    /** @test */
    public function it_fetches_multiple_agents()
    {

        $this->it_fetches_multiple(Agent::class, 'agents');

    }

    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Agent::class, 'agents');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Agent::class, 'agents');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Agent::class, 'agents');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Agent::class, 'agents');
        
    }
    
}
