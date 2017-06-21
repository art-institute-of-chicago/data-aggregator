<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Gallery;

class GalleryTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_all_galleries()
    {

        $this->it_fetches_all(Gallery::class, 'galleries');
        
    }

    /** @test */
    public function it_fetches_a_single_gallery()
    {

        $this->it_fetches_a_single(Gallery::class, 'galleries');

    }

    /** @test */
    public function it_fetches_multiple_galleries()
    {

        $this->it_fetches_multiple(Gallery::class, 'galleries');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Gallery::class, 'galleries');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Gallery::class, 'galleries');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Gallery::class, 'galleries');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Gallery::class, 'galleries');
        
    }

}
