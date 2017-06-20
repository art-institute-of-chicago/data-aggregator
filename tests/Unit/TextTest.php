<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Text;

class TextTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_all_texts()
    {

        $this->it_fetches_all(Text::class, 'texts');
        
    }

    /** @test */
    public function it_fetches_a_single_text()
    {

        $this->it_fetches_a_single(Text::class, 'texts');

    }

    /** @test */
    public function it_fetches_multiple_texts()
    {

        $this->it_fetches_multiple(Text::class, 'texts');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Text::class, 'texts');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Text::class, 'texts');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Text::class, 'texts');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Text::class, 'texts');
        
    }
    
}
