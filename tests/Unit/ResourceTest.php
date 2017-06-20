<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Resource;

class ResourceTest extends ApiTestCase
{

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

        $this->it_fetches_multiple(Resource::class, 'resources');

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

        $this->attach(Category::class, 4)->make(Resource::class);

        $response = $this->getJson('api/v1/resources/' .$this->ids[0] .'/categories');
        $response->assertSuccessful();

        $pubcats = $response->json()['data'];
        $this->assertCount(4, $pubcats);
        
        foreach ($pubcats as $pubcat)
        {
            $this->assertArrayHasKeys($pubcat, ['id', 'title']);
        }
    }

}
