<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\Helpers\Factory;

use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;

abstract class ApiTestCase extends TestCase
{

    use Factory;

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
     * Any additional fields that should typically test as being present.
     *
     * @var array
     */
    protected $keys = [];

    /**
     * Return an id that is valid, yet has a negligent likelihood of pointing at an actual object.
     * Must pass the relevant controller's `validateId` check.
     * Meant to be overwritten. Defaults to numeric id.
     *
     * @var mixed
     */
    protected function getRandomId()
    {
        return app('Faker')->unique()->randomNumber(5);
    }


    public function setUp()
    {

        parent::setUp();

        ini_set('memory_limit', '-1');

        config(['elasticsearch.defaultConnection' => 'testing']);

        \Artisan::call('migrate');

        if (get_class($this) != 'Tests\Unit\AgentTypeTest')
        {

            $agentTypeId = $this->make(AgentType::class, ['title' => 'Individual']);

            if (get_class($this) != 'Tests\Unit\AgentTest')
            {

                $this->times(1)->make(Agent::class, ['agent_type_citi_id' => $agentTypeId, 'is_artist' => TRUE]);

            }

        }

    }


    /** @test */
    public function it_fetches_all_entities()
    {

        $resources = $this->it_fetches_all($this->model, $this->route);

        $this->assertArrayHasKeys($resources, $this->keys, true);

    }

    /** @test */
    public function it_fetches_a_single_entity()
    {

        $resource = $this->it_fetches_a_single($this->model, $this->route);

        $this->assertArrayHasKeys($resource, $this->keys);

    }

    /** @test */
    public function it_fetches_multiple_entities()
    {

        $resources = $this->it_fetches_multiple($this->model, $this->route);

        $this->assertArrayHasKeys($resources, $this->keys, true);

    }



    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s($this->model, $this->route);

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s($this->model, $this->route);

    }

    // @TODO: Fix 404s tests w/ regards to id format

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s($this->model, $this->route);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s($this->model, $this->route);

    }


    public function it_fetches_all($class, $endpoint)
    {

        $this->times(5)->make($class);

        $response = $this->getJson('api/v1/' .$endpoint);
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(5, $resources);

        foreach ($resources as $resource)
        {
            $this->assertArrayHasKeys($resource, ['id', 'title']);
        }

        return $resources;
    }

    public function it_fetches_a_single($class, $endpoint, $extraValue = '')
    {

        $id = $this->make($class);

        $response = $this->getJson('api/v1/' .$endpoint .'/' .$id .($extraValue ? '/' .$extraValue : ''));
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertArrayHasKeys($resource, ['id', 'title']);

        return $resource;
    }

    public function it_fetches_multiple($class, $endpoint)
    {

        $this->times(5)->make($class);

        $response = $this->getJson('api/v1/' .$endpoint .'?ids=' .implode(',',array_slice($this->ids, -3, 3)));
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(3, $resources);

        foreach ($resources as $resource)
        {
            $this->assertArrayHasKeys($resource, ['id', 'title']);
        }

        return $resources;
    }

    public function it_400s($class, $endpoint)
    {

        $this->make($class);

        $response = $this->getJson('api/v1/' .$endpoint .'/fsdfdfs');

        $response->assertStatus(400);

    }

    public function it_403s($class, $endpoint)
    {

        $this->make($class);

        $response = $this->getJson('api/v1/' .$endpoint .'?limit=2000');

        $response->assertStatus(403);

    }

    public function it_404s($class, $endpoint)
    {

        $this->make($class);

        $response = $this->getJson('api/v1/' . $endpoint . '/' . $this->getRandomId());

        $response->assertStatus(404);

    }

    public function it_405s($class, $endpoint)
    {

        $this->make($class);

        $response = $this->postJson('api/v1/' .$endpoint);

        $response->assertStatus(405);

    }

    /** @test */
    public function it_fetches_all_with_fields()
    {

        $validFields = $this->getValidFields();
        $retrievedFields = $validFields->slice(0, 2);
        $discardedFields = $validFields->slice(2);

        $this->times(5)->make($this->model);

        $response = $this->getJson('api/v1/' . $this->route . '?fields=' . $retrievedFields->implode(',') );
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(5, $resources);

        foreach ($resources as $resource)
        {
            $this->assertArrayHasKeys($resource, $retrievedFields);
            $this->assertArrayNotHasKeys($resource, $discardedFields);
        }

        return $resources;
    }

    /** @test */
    public function it_fetches_a_single_with_fields()
    {

        $validFields = $this->getValidFields();
        $retrievedFields = $validFields->slice(0, 2);
        $discardedFields = $validFields->slice(2);

        $id = $this->make($this->model);

        $response = $this->getJson('api/v1/' . $this->route . '/' . $id . '?fields=' . $retrievedFields->implode(',') );
        $response->assertSuccessful();

        $resource = $response->json()['data'];

        $this->assertArrayHasKeys($resource, $retrievedFields);
        $this->assertArrayNotHasKeys($resource, $discardedFields);

        return $resource;
    }

    /** @test */
    public function it_fetches_multiple_with_fields()
    {

        $validFields = $this->getValidFields();
        $retrievedFields = $validFields->slice(0, 2);
        $discardedFields = $validFields->slice(2);

        $this->times(5)->make($this->model);

        $response = $this->getJson('api/v1/' . $this->route . '?ids=' . implode(',',array_slice($this->ids, -3, 3)) . '&fields=' . $retrievedFields->implode(',') );
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(3, $resources);

        foreach ($resources as $resource)
        {
            $this->assertArrayHasKeys($resource, $retrievedFields);
            $this->assertArrayNotHasKeys($resource, $discardedFields);
        }

        return $resources;
    }


    /**
     * Helper to retrieve the full list of fields for a resource as it appears in the API.
     * Meant to account for any weird transformations. Does not discriminate w/ includes.
     *
     * @TODO Determine if the `$extraValue` approach is needed here.
     *
     * @var string
     */
    protected function getValidFields()
    {

        $id = $this->make($this->model);

        $response = $this->getJson('api/v1/' . $this->route . '/' . $id);

        $this->model::findOrFail( $id )->delete();

        return collect( $response->json()['data'] )->keys();

    }


    protected function assertArrayHasKeys($resources = [], $keys = [], $arrayIsMultipleObjects = false)
    {

        // Standardize $resources into an array of multiple objects
        if (!$arrayIsMultipleObjects)
        {
            $resources = [ $resources ];
        }

        foreach ($keys as $key)
        {
            foreach ($resources as $resource)
            {
                $this->assertArrayHasKey($key, $resource);
            }
        }

    }

    protected function assertArrayNotHasKeys($resources = [], $keys = [], $arrayIsMultipleObjects = false)
    {

        // Standardize $resources into an array of multiple objects
        if (!$arrayIsMultipleObjects)
        {
            $resources = [ $resources ];
        }

        foreach ($keys as $key)
        {
            foreach ($resources as $resource)
            {
                $this->assertArrayNotHasKey($key, $resource);
            }
        }

    }

}
