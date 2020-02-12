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

    /**
     * A list of API field names used by the mobile app
     *
     * @var array
     */
    protected $fieldsUsedByMobile = [];

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

    /** @test
     * List of fields taken from https://docs.google.com/spreadsheets/d/1F8YkAb-xaAAfsuWtXmll84nthfsfbBnxm4yU3lX0uLY
     */
    public function it_fetches_fields_used_by_mobile_app()
    {
        if ($this->fieldsUsedByMobile) {
            $m = $this->model();
            $this->times(5)->make($m);

            $response = $this->getJson('api/v1/' . $this->route($m));
            $response->assertSuccessful();

            $resources = $response->json()['data'];
            $this->assertCount(5, $resources);

            foreach ($resources as $resource) {
                $this->assertArrayHasKeys($resource, $this->fieldsUsedByMobile);
            }
        } else {
            $this->assertEmpty($this->fieldsUsedByMobile);
        }
    }
}
