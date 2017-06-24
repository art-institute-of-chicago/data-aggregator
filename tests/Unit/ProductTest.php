<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Shop\Product;
use App\Shop\Category;

class ProductTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_all_products()
    {

        $this->it_fetches_all(Product::class, 'products');
        
    }

    /** @test */
    public function it_fetches_a_single_product()
    {

        $this->it_fetches_a_single(Product::class, 'products');

    }

    /** @test */
    public function it_fetches_multiple_products()
    {

        $this->it_fetches_multiple(Product::class, 'products');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Product::class, 'products');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Product::class, 'products');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Product::class, 'products');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Product::class, 'products');
        
    }

}
