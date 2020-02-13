<?php

namespace Tests\Contract;

use Tests\TestCase;

use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;

abstract class ContractTestCase extends TestCase
{
    /**
     * Reference to the classname of the model being tested.
     *
     * @var string
     */
    protected $model;

    /**
     * Route for the model being tested.
     *
     * @var string
     */
    protected $route;

    protected function setUp(): void
    {
        parent::setUp();

        \Artisan::call('migrate');
    }

    public function model()
    {
        return $this->model;
    }

    public function route($model = '')
    {
        $m = $model ?: $this->model;

        return $this->route ?: app('Resources')->getEndpointForModel($m);
    }

    protected function it_fetches_fields($fields = [])
    {
        if ($fields) {
            $m = $this->model();
            $this->times(5)->make($m);

            $response = $this->getJson('api/v1/' . $this->route($m));
            $response->assertSuccessful();

            $resources = $response->json()['data'];
            $this->assertCount(5, $resources);

            foreach ($resources as $resource) {
                $this->assertArrayHasKeys($resource, $fields);
            }
        } else {
            $this->assertEmpty($fields);
        }
    }
}
