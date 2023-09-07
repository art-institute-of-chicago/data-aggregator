<?php

namespace Tests\Basic;

use App\Models\Collections\Artwork;
use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;

class ArtworkTest extends BasicTestCase
{
    protected $model = Artwork::class;

    protected $keys = ['id'];

    protected function setUp(): void
    {
        parent::setUp();

        $agentType = $this->make(AgentType::class, ['title' => 'Individual']);
        $agent = $this->make(Agent::class, ['agent_type_id' => $agentType->id]);
    }
}
