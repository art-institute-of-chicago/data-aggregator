<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\ObjectType;

class ObjectTypeTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_all_object_types()
    {

        $resources = $this->it_fetches_all(ObjectType::class, 'object-types');
        
        $this->assertArrayHasKeys($resources, ['lake_guid'], true);

    }

    /** @test */
    public function it_fetches_a_single_object_type()
    {

        $resource = $this->it_fetches_a_single(ObjectType::class, 'object-types');
 
        $this->assertArrayHasKeys($resource, ['lake_guid']);

    }

    /** @test */
    public function it_fetches_multiple_object_types()
    {

        $resources = $this->it_fetches_multiple(ObjectType::class, 'object-types');

        $this->assertArrayHasKeys($resources, ['lake_guid'], true);

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(ObjectType::class, 'object-types');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(ObjectType::class, 'object-types');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(ObjectType::class, 'object-types');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(ObjectType::class, 'object-types');
        
    }
    
}
