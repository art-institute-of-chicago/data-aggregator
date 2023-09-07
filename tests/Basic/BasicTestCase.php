<?php

namespace Tests\Basic;

use Tests\TestCase;

abstract class BasicTestCase extends TestCase
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
     * Any additional fields that should typically test as being present.
     *
     * @var array
     */
    protected $keys = [];

    /**
     * A list of API field names used by the mobile app
     *
     * @var array
     */
    protected $fieldsUsedByMobile = [];

    protected function setUp(): void
    {
        parent::setUp();

        ini_set('memory_limit', '-1');

        config(['elasticsearch.defaultConnection' => 'testing']);
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

    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed(): void
    {
        $class = $this->model();
        $endpoint = $this->route($class);

        $model = $this->make($class);

        $response = $this->getJson('api/v1/' . $endpoint . '/fsdfdfs');

        $response->assertStatus(400);

        $class::query()->delete();
    }

    /**
     * WEB-1382, WEB-1189: If the user is authenticated, or the restrictions are removed,
     * then it won't error out. It'll just 200. Removing this test for now.
     */
    public function it_403s_if_limit_is_too_high(): void
    {
        $class = $this->model();
        $endpoint = $this->route($class);

        $model = $this->make($class);

        $response = $this->getJson('api/v1/' . $endpoint . '?limit=2000');

        $response->assertStatus(403);

        $class::query()->delete();
    }

    // @TODO: Fix 404s tests w/ regards to id format

    /** @test */
    public function it_404s_if_not_found(): void
    {
        $class = $this->model();
        $endpoint = $this->route($class);

        $model = $this->make($class);

        $response = $this->getJson('api/v1/' . $endpoint . '/' . $this->getRandomId());

        $response->assertStatus(404);

        $class::query()->delete();
    }

    public function it_fetches_all(): void
    {
        $class = $this->model();
        $endpoint = $this->route($class);

        $models = $this->times(5)->make($class);

        $response = $this->getJson('api/v1/' . $endpoint);
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(5, $resources);

        foreach ($resources as $resource) {
            $this->assertArrayHasKeys($resource, ['id', 'title']);
        }

        $this->assertArrayHasKeys($resources, $this->keys, true);

        $class::query()->delete();
    }

    public function it_fetches_a_single($extraValue = ''): void
    {
        $class = $this->model();
        $endpoint = $this->route($class);

        $model = $this->make($class);
        $id = $model->getAttributeValue($lastModel->getKeyName());

        $response = $this->getJson('api/v1/' . $endpoint . '/' . $id . ($extraValue ? '/' . $extraValue : ''));
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertArrayHasKeys($resource, ['id', 'title']);

        $this->assertArrayHasKeys($resource, $this->keys);

        $class::query()->delete();
    }

    public function it_fetches_multiple(): void
    {
        $class = $this->model();
        $endpoint = $this->route($class);

        $models = $this->times(5)->make($class);

        $response = $this->getJson('api/v1/' . $endpoint . '?ids=' . implode(',', array_slice($this->ids, -3, 3)));
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(3, $resources);

        foreach ($resources as $resource) {
            $this->assertArrayHasKeys($resource, ['id', 'title']);
        }
        $this->assertArrayHasKeys($resources, $this->keys, true);

        $class::query()->delete();
    }

    /** @test */
    public function it_fetches_all_with_fields(): void
    {
        $validFields = $this->getValidFields();
        $retrievedFields = $validFields->slice(0, 2);
        $discardedFields = $validFields->slice(2);

        $m = $this->model();
        $models = $this->times(5)->make($m);

        $response = $this->getJson('api/v1/' . $this->route($m) . '?fields=' . $retrievedFields->implode(','));
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(5, $resources);

        foreach ($resources as $resource) {
            $this->assertArrayHasKeys($resource, $retrievedFields);
            $this->assertArrayNotHasKeys($resource, $discardedFields);
        }

        $m::query()->delete();
    }

    /** @test */
    public function it_fetches_a_single_with_fields(): void
    {
        $validFields = $this->getValidFields();
        $retrievedFields = $validFields->slice(0, 2);
        $discardedFields = $validFields->slice(2);

        $m = $this->model();
        $model = $this->make($m);
        $id = $model->getAttributeValue($model->getKeyName());

        $response = $this->getJson('api/v1/' . $this->route($m) . '/' . $id . '?fields=' . $retrievedFields->implode(','));
        $response->assertSuccessful();

        $resource = $response->json()['data'];

        $this->assertArrayHasKeys($resource, $retrievedFields);
        $this->assertArrayNotHasKeys($resource, $discardedFields);

        $m::query()->delete();
    }

    /** @test */
    public function it_fetches_multiple_with_fields(): void
    {
        $validFields = $this->getValidFields();
        $retrievedFields = $validFields->slice(0, 2);
        $discardedFields = $validFields->slice(2);

        $m = $this->model();
        $models = $this->times(5)->make($m);
        $response = $this->getJson('api/v1/' . $this->route($m) . '?ids=' . implode(',', $models->slice(1, 3)->modelKeys()) . '&fields=' . $retrievedFields->implode(','));
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(3, $resources);

        foreach ($resources as $resource) {
            $this->assertArrayHasKeys($resource, $retrievedFields);
            $this->assertArrayNotHasKeys($resource, $discardedFields);
        }

        $m::query()->delete();
    }

    /** @test
     * List of fields taken from https://docs.google.com/spreadsheets/d/1F8YkAb-xaAAfsuWtXmll84nthfsfbBnxm4yU3lX0uLY
     */
    public function it_fetches_fields_used_by_mobile_app(): void
    {
        if ($this->fieldsUsedByMobile) {
            $m = $this->model();
            $models = $this->times(5)->make($m);

            $response = $this->getJson('api/v1/' . $this->route($m));
            $response->assertSuccessful();

            $resources = $response->json()['data'];
            $this->assertCount(5, $resources);

            foreach ($resources as $resource) {
                $this->assertArrayHasKeys($resource, $this->fieldsUsedByMobile);
            }

            $class::query()->delete();
        } else {
            $this->assertEmpty($this->fieldsUsedByMobile);
        }
    }

    /**
     * Return an id that is valid, yet has a negligent likelihood of pointing at an actual object.
     * Must pass the relevant controller's `validateId` check.
     * Meant to be overwritten. Defaults to numeric id.
     *
     * @var mixed
     */
    protected function getRandomId()
    {
        return fake()->unique()->randomNumber(5);
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
        $m = $this->model();
        $model = $this->make($m);
        $id = $model->getKey();

        $response = $this->getJson('api/v1/' . $this->route($m) . '/' . $id);

        $m::query()->delete();

        return collect($response->json()['data'])->keys();
    }
}
