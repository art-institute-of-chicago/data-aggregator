<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Category;

class CategoryTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_all_categories()
    {

        $this->it_fetches_all(Category::class, 'categories');
        
    }

    /** @test */
    public function it_fetches_a_single_category()
    {

        $this->it_fetches_a_single(Category::class, 'categories');

    }

    /** @test */
    public function it_fetches_multiple_categories()
    {

        $this->it_fetches_multiple(Category::class, 'categories');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Category::class, 'categories');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Category::class, 'categories');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Category::class, 'categories');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Category::class, 'categories');
        
    }
    
}
