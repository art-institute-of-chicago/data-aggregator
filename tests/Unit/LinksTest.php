<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Link;

use Tests\Helpers\Factory;

class LinkTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_links()
    {

        $this->it_fetches_all(Link::class, 'links');
        
    }

    /** @test */
    public function it_fetches_a_single_link()
    {

        $this->it_fetches_a_single(Link::class, 'links');

    }

    /** @test */
    public function it_fetches_multiple_links()
    {

        $this->it_fetches_mutliple(Link::class, 'links');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Link::class, 'links');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Link::class, 'links');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Link::class, 'links');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Link::class, 'links');
        
    }


    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'content' => $this->faker->url,
            'lake_guid' => $lake_id,
            'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
