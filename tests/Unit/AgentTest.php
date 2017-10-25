<?php

namespace Tests\Unit;

use App\Models\Collections\Agent;

class AgentTest extends ApiTestCase
{

    protected $model = Agent::class;

    protected $route = 'agents';

    protected $keys = ['lake_guid'];

}
