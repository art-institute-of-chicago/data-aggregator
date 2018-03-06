<?php

namespace Tests\Unit;

use App\Models\Collections\Agent;

class AgentTest extends ApiTestCase
{

    protected $model = Agent::class;

    protected $keys = ['lake_guid'];

    /** @test */
    public function it_fetches_boosted_agents()
    {

        $this->make(Agent::class, ['citi_id' => 101310]);
        $this->make(Agent::class, ['citi_id' => 34028]);
        $this->make(Agent::class, ['citi_id' => 40869]);
        $this->make(Agent::class, ['citi_id' => 50495]);
        $this->make(Agent::class, ['citi_id' => 81689]);
        $resources = $this->it_fetches_multiple(Agent::class, 'agents/boosted');

        $this->assertArrayHasKeys($resources, ['lake_guid'], true);

    }

}
