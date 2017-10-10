<?php

namespace Tests\Unit;

use App\Models\Collections\AgentType;

class AgentTypeTest extends ApiTestCase
{

    protected $model = AgentType::class;

    protected $route = 'agent-types';

    protected $keys = ['lake_guid'];

}
