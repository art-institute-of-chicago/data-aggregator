<?php

namespace Tests;

use Tests\Helpers\Factory;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    use Factory;

    protected function setUp(): void
    {
        parent::setUp();

        ini_set('memory_limit', '-1');

        config(['elasticsearch.defaultConnection' => 'testing']);
    }

    /**
     * The default behavior runs `artisan migrate` before each test.
     * Instead, we'll manage making sure records don't collide in our code
     * since our migrate command is pretty heavy, and only have the migrations
     * run once.
     */
    public function refreshDatabase()
    {
        $this->refreshTestDatabase();
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

    protected function debug($output)
    {
        fwrite(STDERR, 'DEBUG: ' . print_r($output, true) . "\n");
    }
}
