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

        $this->it_fetches_all(Resource::class, 'resources');
        
    }

    /** @test */
    public function it_fetches_a_single_resource()
    {

        $this->it_fetches_a_single(Resource::class, 'resources');

    }

    /** @test */
    public function it_fetches_multiple_resources()
    {

        $this->it_fetches_mutliple(Resource::class, 'resources');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Resource::class, 'resources');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Resource::class, 'resources');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Resource::class, 'resources');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Resource::class, 'resources');
        
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

    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'title' => $this->faker->words(4, true),
            'lake_guid' => $lake_id,
            'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
