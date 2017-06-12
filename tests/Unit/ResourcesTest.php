<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Resource;

use Tests\Helpers\Factory;

class ResourceTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_resources()
    {
        $this->times(5)->make(Resource::class);
        
        $response = $this->getJson('api/v1/resources');
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(5, $resources);

        foreach ($resources as $resource)
        {
            $this->assertArrayHasKeys($resource, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_resource()
    {

        $this->make(Resource::class);

        $response = $this->getJson('api/v1/resources/' .$this->ids[0]);
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertArrayHasKeys($resource, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_resources()
    {

        $this->times(5)->make(Resource::class);

        $response = $this->getJson('api/v1/resources?ids=' .implode(',',array_slice($this->ids, 0, 3)));
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(3, $resources);

        foreach ($resources as $resource)
        {
            $this->assertArrayHasKeys($resource, ['id', 'title']);
        }
    }

    /** @test */
    public function it_404s_if_a_resource_is_not_found()
    {

        $this->make(Resource::class);
        
        $response = $this->getJson('api/v1/resources/' .$this->faker->unique()->randomNumber(5));

        $response->assertStatus(404);

    }

    /** @test */
    public function it_400s_if_an_alpha_id_is_passed()
    {

        $this->make(Resource::class);
        
        $response = $this->getJson('api/v1/resources/fsdfdfs');

        $response->assertStatus(400);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->make(Resource::class);
        
        $response = $this->postJson('api/v1/resources');

        $response->assertStatus(405);

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->make(Resource::class);
        
        $response = $this->getJson('api/v1/resources?limit=2000');

        $response->assertStatus(403);

    }


    /** @test */
    public function it_fetches_categories_for_a_resource()
    {

        $this->make(Resource::class);
        $this->times(4)->make(Category::class, ['resource_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/resources/' .$this->ids[0] .'/categories');
        $response->assertSuccessful();

        $pubcats = $response->json()['data'];
        $this->assertCount(4, $pubcats);
        
        foreach ($pubcats as $pubcat)
        {
            $this->assertArrayHasKeys($pubcat, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_category_for_a_resource()
    {

        $this->make(Resource::class);
        $this->make(PCategory::class, ['resource_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/resources/' .$this->ids[0] .'/categories/' .$this->ids[1]);
        $response->assertSuccessful();

        $pubcat = $response->json()['data'];
        $this->assertArrayHasKeys($pubcat, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_categorys_for_a_resource()
    {

        $this->make(Resource::class);
        $this->times(5)->make(Category::class, ['resource_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/resources/' .$this->ids[0] .'/categories?ids=' .implode(',',array_slice($this->ids, 1, 3)));
        $response->assertSuccessful();

        $pubcats = $response->json()['data'];
        $this->assertCount(3, $pubcats);
        
        foreach ($pubcats as $pubcat)
        {
            $this->assertArrayHasKeys($pubcat, ['id', 'title']);
        }
    }

    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(4),
            'title' => $this->faker->words(4, true),
            'lake_guid' => $lake_id,
            'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
