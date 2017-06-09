<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Faker\Factory as Faker;

abstract class ApiTestCase extends TestCase
{

    protected $faker;
    

    function __construct()
    {

        $this->faker = Faker::create();
        
    }

    public function setUp()
    {

        parent::setUp();
        \Artisan::call('migrate');
    }

    protected function assertArrayHasKeys($array = [], $keys = [])
    {

        foreach ($keys as $key)
        {

            $this->assertArrayHasKey($key, $array);

        }

    }

}
