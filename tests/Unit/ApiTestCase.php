<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Faker\Factory as Faker;

use Tests\Helpers\Factory;

use App\Collections\AgentType;
use App\Collections\Agent;

abstract class ApiTestCase extends TestCase
{

    use Factory;

    protected $faker;
    

    function __construct()
    {

        $this->faker = Faker::create();
        
    }

    public function setUp()
    {

        parent::setUp();
        \Artisan::call('migrate');

        if (get_class($this) != 'Tests\Unit\AgentTypeTest')
        {

            $agentTypeId = $this->make(AgentType::class, ['title' => 'Artist']);

            if (get_class($this) != 'Tests\Unit\AgentTest')
            {

                $this->times(1)->make(Agent::class, ['agent_type_citi_id' => $agentTypeId]);

            }

        }

    }

    protected function assertArrayHasKeys($resources = [], $keys = [], $arrayIsMultipleObjects = false)
    {

        foreach ($keys as $key)
        {

            if ($arrayIsMultipleObjects) {

                foreach ($resources as $resource)
                {

                    $this->assertArrayHasKey($key, $resource);

                }

            }
            else
            {

                $this->assertArrayHasKey($key, $resources);

            }

        }

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

    public function it_404s($class, $endpoint, $useUuid = false)
    {

        $this->make($class);
        
        $response = $this->getJson('api/v1/' .$endpoint .'/' .$useUuid ? $this->faker->unique()->uuid : $this->faker->unique()->randomNumber(5));

        $response->assertStatus(404);

    }

    public function it_405s($class, $endpoint)
    {

        $this->make($class);
        
        $response = $this->postJson('api/v1/' .$endpoint);

        $response->assertStatus(405);

    }

}
