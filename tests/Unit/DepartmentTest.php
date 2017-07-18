<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Department;

class DepartmentTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_all_departments()
    {

        $resources = $this->it_fetches_all(Department::class, 'departments');

        $this->assertArrayHasKeys($resources, ['lake_guid'], true);

    }

    /** @test */
    public function it_fetches_a_single_department()
    {

        $resource = $this->it_fetches_a_single(Department::class, 'departments');

        $this->assertArrayHasKeys($resource, ['lake_guid']);

    }

    /** @test */
    public function it_fetches_multiple_departments()
    {

        $resources = $this->it_fetches_multiple(Department::class, 'departments');

        $this->assertArrayHasKeys($resources, ['lake_guid'], true);

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Department::class, 'departments');

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Department::class, 'departments');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Department::class, 'departments');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Department::class, 'departments');

    }

}
