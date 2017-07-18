<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\AgentType;

use Tests\Helpers\Factory;

class AgentTypeTest extends ApiTestCase
{

    use Factory;

    /** @test */
    public function it_fetches_all_agent_types()
    {

        $resources = $this->it_fetches_all(AgentType::class, 'agent-types');

        $this->assertArrayHasKeys($resources, ['lake_guid'], true);

    }

    /** @test */
    public function it_fetches_a_single_agent_type()
    {

        $resource = $this->it_fetches_a_single(AgentType::class, 'agent-types');

        $this->assertArrayHasKeys($resource, ['lake_guid']);

    }

    /** @test */
    public function it_fetches_multiple_agent_types()
    {

        $resources = $this->it_fetches_multiple(AgentType::class, 'agent-types');

        $this->assertArrayHasKeys($resources, ['lake_guid'], true);

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(AgentType::class, 'agent-types');

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(AgentType::class, 'agent-types');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(AgentType::class, 'agent-types');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(AgentType::class, 'agent-types');

    }

}
