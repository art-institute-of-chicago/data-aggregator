<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Collections\AgentType;

use Tests\Helpers\Factory;

class AgentTypeTest extends ApiTestCase
{

    use Factory;

    protected $model = AgentType::class;

    protected $route = 'agent-types';

    protected $keys = ['lake_guid'];

}
