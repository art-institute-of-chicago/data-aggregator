<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Dsc\Footnote;
use App\Models\Dsc\Publication;
use App\Models\Dsc\Section;

class FootnoteTest extends ApiTestCase
{

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);
        $this->times(5)->make(Section::class);

    }

    /** @test */
    public function it_fetches_all_footnotes()
    {

        $this->it_fetches_all(Footnote::class, 'footnotes');

    }

    /** @test */
    public function it_fetches_a_single_footnote()
    {

        $this->it_fetches_a_single(Footnote::class, 'footnotes');

    }

    /** @test */
    public function it_fetches_multiple_footnotes()
    {

        $this->it_fetches_multiple(Footnote::class, 'footnotes');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Footnote::class, 'footnotes');

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Footnote::class, 'footnotes');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Footnote::class, 'footnotes');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Footnote::class, 'footnotes');

    }

}
