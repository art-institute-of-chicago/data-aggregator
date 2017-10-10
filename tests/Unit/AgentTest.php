<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Collections\Agent;

class AgentTest extends ApiTestCase
{

    protected $model = Agent::class;

    protected $route = 'agents';

    protected $keys = ['lake_guid'];

}
