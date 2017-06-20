<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Exhibition;
use App\Collections\Gallery;
use App\Collections\Department;
use App\Collections\Artwork;

class ExhibitionTest extends ApiTestCase
{

    public function setUp()
    {

        parent::setUp();
        $this->make(Gallery::class);
        $this->make(Department::class);

    }
    
    /** @test */
    public function it_fetches_all_exhibitions()
    {

        $this->it_fetches_all(Exhibition::class, 'exhibitions');
        
    }

    /** @test */
    public function it_fetches_a_single_exhibition()
    {

        $this->it_fetches_a_single(Exhibition::class, 'exhibitions');

    }

    /** @test */
    public function it_fetches_multiple_exhibitions()
    {

        $this->it_fetches_multiple(Exhibition::class, 'exhibitions');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Exhibition::class, 'exhibitions');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Exhibition::class, 'exhibitions');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Exhibition::class, 'exhibitions');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Exhibition::class, 'exhibitions');
        
    }


    /** @test */
    public function it_fetches_artworks_for_an_exhibition()
    {

        $this->attach(Artwork::class, 4)->make(Exhibition::class);

        $response = $this->getJson('api/v1/exhibitions/' .$this->ids[0] .'/artworks');
        $response->assertSuccessful();

        $artworks = $response->json()['data'];
        $this->assertCount(4, $artworks);
        
        foreach ($artworks as $artwork)
        {
            $this->assertArrayHasKeys($artwork, ['id', 'title']);
        }
    }

}
