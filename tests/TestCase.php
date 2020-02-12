<?php

namespace Tests;

use Tests\Helpers\Factory;

use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use Factory;

    protected function setUp(): void
    {
        parent::setUp();

        ini_set('memory_limit', '-1');

        config(['elasticsearch.defaultConnection' => 'testing']);

        \Artisan::call('migrate');

        if (class_basename(get_class($this)) !== 'AgentTypeTest') {
            $agentTypeId = $this->make(AgentType::class, ['title' => 'Individual']);

            if (class_basename(get_class($this)) !== 'AgentTest') {
                $this->times(1)->make(Agent::class, ['agent_type_citi_id' => $agentTypeId]);
            }
        }
    }

    protected function assertArrayHasKeys($resources = [], $keys = [], $arrayIsMultipleObjects = false)
    {
        // Standardize $resources into an array of multiple objects
        if (!$arrayIsMultipleObjects) {
            $resources = [$resources];
        }

        foreach ($keys as $key) {
            foreach ($resources as $resource) {
                $this->assertArrayHasKey($key, $resource);
            }
        }
    }

    protected function assertArrayNotHasKeys($resources = [], $keys = [], $arrayIsMultipleObjects = false)
    {
        // Standardize $resources into an array of multiple objects
        if (!$arrayIsMultipleObjects) {
            $resources = [$resources];
        }

        foreach ($keys as $key) {
            foreach ($resources as $resource) {
                $this->assertArrayNotHasKey($key, $resource);
            }
        }
    }
}
