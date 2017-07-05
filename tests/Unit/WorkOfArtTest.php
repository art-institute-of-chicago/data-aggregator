<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Dsc\WorkOfArt;
use App\Dsc\Publication;
use App\Collections\Artwork;

class WorkOfArtTest extends ApiTestCase
{

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);
        $this->times(5)->make(Artwork::class);

    }

    /** @test */
    public function it_fetches_all_work_of_arts()
    {

        $this->it_fetches_all(WorkOfArt::class, 'works-of-art');
        
    }

    /** @test */
    public function it_fetches_a_single_work_of_art()
    {

        $this->it_fetches_a_single(WorkOfArt::class, 'works-of-art');

    }

    /** @test */
    public function it_fetches_multiple_work_of_arts()
    {

        $this->it_fetches_multiple(WorkOfArt::class, 'works-of-art');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(WorkOfArt::class, 'works-of-art');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(WorkOfArt::class, 'works-of-art');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(WorkOfArt::class, 'works-of-art');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(WorkOfArt::class, 'works-of-art');
        
    }

}
