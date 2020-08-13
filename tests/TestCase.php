<?php

namespace Tests;

use Tests\Helpers\Factory;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseSetup;
    use Factory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setupDatabase();

        ini_set('memory_limit', '-1');

        config(['elasticsearch.defaultConnection' => 'testing']);
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
