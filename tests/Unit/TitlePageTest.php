<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Dsc\TitlePage;
use App\Dsc\Publication;

class TitlePageTest extends ApiTestCase
{

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);

    }

    /** @test */
    public function it_fetches_all_title_pages()
    {

        $this->it_fetches_all(TitlePage::class, 'title-pages');
        
    }

    /** @test */
    public function it_fetches_a_single_title_page()
    {

        $this->it_fetches_a_single(TitlePage::class, 'title-pages');

    }

    /** @test */
    public function it_fetches_multiple_title_pages()
    {

        $this->it_fetches_multiple(TitlePage::class, 'title-pages');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(TitlePage::class, 'title-pages');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(TitlePage::class, 'title-pages');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(TitlePage::class, 'title-pages');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(TitlePage::class, 'title-pages');
        
    }

}
