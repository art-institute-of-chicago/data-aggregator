<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Exhibition;
use App\Collections\Gallery;
use App\Collections\Department;
use App\Collections\Artwork;
use App\Collections\AgentType;
use App\Collections\Agent;

class ExhibitionTest extends ApiTestCase
{

    public function setUp()
    {

        parent::setUp();
        $this->make(Gallery::class);
        $this->make(Department::class);
        $this->times(5)->make(Agent::class);

    }

    /** @test */
    public function it_fetches_all_exhibitions()
    {

        $resources = $this->it_fetches_all(Exhibition::class, 'exhibitions');

        $this->assertArrayHasKeys($resources, ['lake_guid'], true);

    }

    /** @test */
    public function it_fetches_a_single_exhibition()
    {

        $resource = $this->it_fetches_a_single(Exhibition::class, 'exhibitions');

        $this->assertArrayHasKeys($resource, ['lake_guid']);

    }

    /** @test */
    public function it_fetches_multiple_exhibitions()
    {

        $resources = $this->it_fetches_multiple(Exhibition::class, 'exhibitions');

        $this->assertArrayHasKeys($resources, ['lake_guid'], true);

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

        $exhibitionId = $this->attach(Artwork::class, 4)->make(Exhibition::class);

        $response = $this->getJson('api/v1/exhibitions/' .$exhibitionId .'/artworks');
        $response->assertSuccessful();

        $artworks = $response->json()['data'];
        $this->assertCount(4, $artworks);

        foreach ($artworks as $artwork)
        {
            $this->assertArrayHasKeys($artwork, ['id', 'title']);
        }
    }


    /** @test */
    public function it_fetches_venues_for_an_exhibition()
    {

        $corporateBodyAgentType = $this->make(AgentType::class, ['title' => 'Corporate Body']);
        $exhibitionId = $this->attach(Agent::class, 4, 'venues', ['agent_type_citi_id' => $corporateBodyAgentType])->make(Exhibition::class);

        $response = $this->getJson('api/v1/exhibitions/' .$exhibitionId .'/venues');
        $response->assertSuccessful();

        $venues = $response->json()['data'];
        $this->assertCount(4, $venues);

        foreach ($venues as $venue)
        {
            $this->assertArrayHasKeys($venue, ['id', 'title']);
        }
    }

}
