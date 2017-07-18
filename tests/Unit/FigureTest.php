<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Dsc\Figure;
use App\Dsc\Publication;
use App\Dsc\Section;

class FigureTest extends ApiTestCase
{

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);
        $this->times(5)->make(Section::class);

    }

    /** @test */
    public function it_fetches_all_figures()
    {

        $this->it_fetches_all(Figure::class, 'figures');

    }

    /** @test */
    public function it_fetches_a_single_figure()
    {

        $this->it_fetches_a_single(Figure::class, 'figures');

    }

    /** @test */
    public function it_fetches_multiple_figures()
    {

        $this->it_fetches_multiple(Figure::class, 'figures');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Figure::class, 'figures');

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Figure::class, 'figures');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Figure::class, 'figures');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Figure::class, 'figures');

    }

}
