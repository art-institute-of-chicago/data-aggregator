<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Dsc\Publication;

class PublicationTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_all_publications()
    {

        $this->it_fetches_all(Publication::class, 'publications');

    }

    /** @test */
    public function it_fetches_a_single_publication()
    {

        $this->it_fetches_a_single(Publication::class, 'publications');

    }

    /** @test */
    public function it_fetches_multiple_publications()
    {

        $this->it_fetches_multiple(Publication::class, 'publications');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Publication::class, 'publications');

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Publication::class, 'publications');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Publication::class, 'publications');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Publication::class, 'publications');

    }

}
