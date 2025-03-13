<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Tests\Helpers\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use Factory;
    use RefreshDatabase {
        RefreshDatabase::refreshTestDatabase as parentRefreshTestDatabase;
    }

    protected function setUp(): void
    {
        parent::setUp();

        ini_set('memory_limit', '-1');

        config(['elasticsearch.defaultConnection' => 'testing']);
    }

    protected function assertArrayHasKeys($resources = [], $keys = [], $arrayIsMultipleObjects = false): void
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

    protected function assertArrayNotHasKeys($resources = [], $keys = [], $arrayIsMultipleObjects = false): void
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

    protected function debug($output): void
    {
        fwrite(STDERR, 'DEBUG: ' . print_r($output, true) . "\n");
    }

    protected function refreshTestDatabase()
    {
        if (! RefreshDatabaseState::$migrated) {
            $this->artisan('db:wipe', [
                '--database' => 'vectors',
                '--force' => true
            ]);
        }
        $this->parentRefreshTestDatabase();
    }
}
